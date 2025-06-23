<?php

namespace App\Http\Controllers;

use App\Models\VolunteerEventApplication;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\VolunteerEventApplicationConfirmation;
use App\Mail\VolunteerEventApplicationStatusUpdate;

class VolunteerEventApplicationController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'full_name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255'],
            'phone_number' => ['required', 'string', 'regex:/^\d{11}$/'],
            'application_reason' => 'required|string|max:1000',
            'volunteer_description' => 'required|string|max:1000',
            'valid_id' => 'required|file|mimes:jpeg,jpg,png,pdf|max:5120' // 5MB max
        ], [
            'phone_number.regex' => 'Phone number must be exactly 11 digits.',
            'volunteer_description.required' => 'Please describe yourself as a volunteer.',
            'valid_id.required' => 'Please upload a valid ID.',
            'valid_id.mimes' => 'Valid ID must be a JPEG, JPG, PNG, or PDF file.',
            'valid_id.max' => 'Valid ID file size must not exceed 5MB.'
        ]);

        try {
            // Handle file upload
            $validIdPath = null;
            if ($request->hasFile('valid_id')) {
                $file = $request->file('valid_id');
                $filename = time() . '_' . $file->getClientOriginalName();
                $validIdPath = $file->storeAs('volunteer_ids', $filename, 'public');
            }

            // Generate unique tracking code
            do {
                $trackingCode = strtoupper(Str::random(8));
            } while (VolunteerEventApplication::where('tracking_code', $trackingCode)->exists());

            $application = VolunteerEventApplication::create([
                'event_id' => $request->event_id,
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'application_reason' => $request->application_reason,
                'volunteer_description' => $request->volunteer_description,
                'valid_id_path' => $validIdPath,
                'tracking_code' => $trackingCode,
                'status' => 'pending'
            ]);

            // Send confirmation email
            try {
                Mail::to($application->email)->send(new VolunteerEventApplicationConfirmation($application));
                Log::info('Volunteer application confirmation email sent', [
                    'application_id' => $application->id,
                    'email' => $application->email,
                    'tracking_code' => $trackingCode
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to send volunteer application confirmation email: ' . $e->getMessage(), [
                    'application_id' => $application->id,
                    'email' => $application->email,
                    'tracking_code' => $trackingCode
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Application submitted successfully! Please check your email for confirmation and tracking code.',
                'tracking_code' => $trackingCode
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to create volunteer application: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to submit application. Please try again.'
            ], 500);
        }
    }

    public function index()
    {
        $applications = VolunteerEventApplication::with('event')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.volunteer-applications.index', compact('applications'));
    }

    public function show(VolunteerEventApplication $application)
    {
        $application->load('event');

        // Add the full URL for the uploaded image
        $applicationData = $application->toArray();
        if ($application->valid_id_path) {
            $applicationData['valid_id_url'] = asset('storage/' . $application->valid_id_path);
        }

        return response()->json($applicationData);
    }

    public function updateStatus(Request $request, VolunteerEventApplication $application)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'admin_notes' => 'nullable|string'
        ]);

        $oldStatus = $application->status;
        $application->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes
        ]);

        // Send status update email if status changed
        if ($oldStatus !== $request->status) {
            try {
                Mail::to($application->email)->send(new VolunteerEventApplicationStatusUpdate($application));
                Log::info('Volunteer application status update email sent', [
                    'application_id' => $application->id,
                    'email' => $application->email,
                    'old_status' => $oldStatus,
                    'new_status' => $request->status,
                    'tracking_code' => $application->tracking_code
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to send volunteer application status update email: ' . $e->getMessage(), [
                    'application_id' => $application->id,
                    'email' => $application->email,
                    'status' => $request->status,
                    'tracking_code' => $application->tracking_code
                ]);
            }
        }

        // If approved, create both volunteer record and user account
        $user = null;
        $isNewUser = false;
        $defaultPassword = 'volunteer123';

        if ($request->status === 'approved') {
            // Check if volunteer with this email already exists
            $existingVolunteer = \App\Models\Volunteer::where('email', $application->email)->first();

            // Check if user with this email already exists
            $existingUser = \App\Models\User::where('email', $application->email)->first();

            if (!$existingVolunteer) {
                // Create volunteer record in volunteer directory
                $newVolunteer = \App\Models\Volunteer::create([
                    'name' => $application->full_name,
                    'email' => $application->email,
                    'phone' => $application->phone_number,
                    'skills' => json_encode(['Event Volunteer']),
                    'status' => 'Active', // Set as Active since it's approved
                    'notes' => 'Approved from event application: ' . $application->event->title . '. Reason: ' . $application->application_reason,
                    'start_date' => now(),
                ]);

                Log::info('New volunteer created in directory from event application', [
                    'volunteer_id' => $newVolunteer->id,
                    'application_id' => $application->id,
                    'email' => $application->email
                ]);
            }

            if ($existingUser) {
                // Update existing user to volunteer role
                $existingUser->role = 'volunteer';
                $existingUser->status = 'active';
                $existingUser->phone_number = $application->phone_number;
                // Add volunteer-specific information to user record
                $existingUser->skills = json_encode(['Event Volunteer']);
                $existingUser->notes = 'Approved from event application: ' . $application->event->title . '. Reason: ' . $application->application_reason;
                $existingUser->start_date = now();
                $existingUser->save();
                $user = $existingUser;

                Log::info('Existing user updated to volunteer role from event application', [
                    'user_id' => $user->id,
                    'application_id' => $application->id,
                    'email' => $application->email
                ]);
            } else {
                // Create user account for user management
                $user = \App\Models\User::create([
                    'name' => $application->full_name,
                    'email' => $application->email,
                    'password' => Hash::make($defaultPassword), // Default password
                    'role' => 'volunteer',
                    'status' => 'active', // Explicitly set status to active
                    'phone_number' => $application->phone_number, // Add phone number
                    'skills' => json_encode(['Event Volunteer']), // Default skill
                    'notes' => 'Approved from event application: ' . $application->event->title . '. Reason: ' . $application->application_reason,
                    'start_date' => now(),
                    'email_verified_at' => now(),
                ]);
                $isNewUser = true;

                // Log the user creation for debugging
                Log::info('New user created from event application', [
                    'user_id' => $user->id,
                    'application_id' => $application->id,
                    'email' => $application->email,
                    'role' => 'volunteer',
                    'status' => 'active'
                ]);
            }
        }

        $message = 'Application status updated successfully';
        if ($request->status === 'approved' && $user) {
            $message .= $isNewUser
                ? ". Volunteer approved and added to both Volunteer Directory and User Management with default password '{$defaultPassword}'. Please update the account details."
                : '. Volunteer approved and added to both Volunteer Directory and User Management. Please review the account details.';
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'status' => $request->status,
            'application' => $application,
            'user_created' => $request->status === 'approved' && $user,
            'user_id' => $user ? $user->id : null,
            'is_new_user' => $isNewUser,
            'default_password' => $isNewUser ? $defaultPassword : null,
            'redirect_to_user_management' => $request->status === 'approved' && $user
        ]);
    }

    public function showTrackForm()
    {
        return view('volunteer.track-event-application');
    }

    public function track(Request $request)
    {
        $request->validate([
            'tracking_code' => 'required|string|size:8'
        ]);

        $application = VolunteerEventApplication::with('event')
            ->where('tracking_code', $request->tracking_code)
            ->first();

        if (!$application) {
            return back()->with('error', 'Invalid tracking code. Please check and try again.');
        }

        return view('volunteer.track-event-application', compact('application'));
    }

    public function showByTrackingCode($tracking_code)
    {
        $application = VolunteerEventApplication::with('event')
            ->where('tracking_code', $tracking_code)
            ->firstOrFail();

        return view('volunteer.event-application-status', compact('application'));
    }

    public function storeAuto(Request $request): JsonResponse
    {
        $request->validate([
            'event_id' => 'required|exists:events,id'
        ]);

        try {
            $user = auth()->user();

            // Check if user already applied for this event
            $existingApplication = VolunteerEventApplication::where('event_id', $request->event_id)
                ->where('email', $user->email)
                ->first();

            if ($existingApplication) {
                return response()->json([
                    'success' => false,
                    'message' => 'You have already applied for this event. Your tracking code is: ' . $existingApplication->tracking_code
                ]);
            }

            // Generate unique tracking code with current year prefix
            $currentYear = date('Y');
            do {
                $trackingCode = $currentYear . strtoupper(Str::random(6));
            } while (VolunteerEventApplication::where('tracking_code', $trackingCode)->exists());

            // Create application using existing user data
            $application = VolunteerEventApplication::create([
                'event_id' => $request->event_id,
                'full_name' => $user->name,
                'email' => $user->email,
                'phone_number' => $user->phone_number ?? 'N/A',
                'application_reason' => 'Automatic application using existing volunteer account',
                'tracking_code' => $trackingCode,
                'status' => 'pending'
            ]);

            // Send confirmation email
            try {
                Mail::to($application->email)->send(new VolunteerEventApplicationConfirmation($application));
                Log::info('Auto volunteer application confirmation email sent', [
                    'application_id' => $application->id,
                    'user_id' => $user->id,
                    'email' => $application->email,
                    'tracking_code' => $trackingCode
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to send auto volunteer application confirmation email: ' . $e->getMessage(), [
                    'application_id' => $application->id,
                    'user_id' => $user->id,
                    'email' => $application->email,
                    'tracking_code' => $trackingCode
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Application submitted successfully using your existing account information!',
                'tracking_code' => $trackingCode
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to create auto volunteer application: ' . $e->getMessage(), [
                'user_id' => auth()->id(),
                'event_id' => $request->event_id
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to submit application. Please try again.'
            ], 500);
        }
    }
}
