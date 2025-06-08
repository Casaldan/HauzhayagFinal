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
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'application_reason' => 'required|string|max:1000'
        ]);

        try {
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
        return response()->json($application);
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

        // If approved, create a new volunteer record and user account
        if ($request->status === 'approved') {
            // Check if volunteer with this email already exists
            $existingVolunteer = \App\Models\Volunteer::where('email', $application->email)->first();

            // Check if user with this email already exists
            $existingUser = \App\Models\User::where('email', $application->email)->first();

            if (!$existingVolunteer) {
                $newVolunteer = \App\Models\Volunteer::create([
                    'name' => $application->full_name,
                    'email' => $application->email,
                    'phone' => $application->phone_number, // Use actual phone number from application
                    'skills' => json_encode(['Event Volunteer']), // Default skill
                    'status' => 'Active', // Use 'Active' to match the enum in migration
                    'notes' => 'Created from event application: ' . $application->event->title . '. Reason: ' . $application->application_reason,
                    'start_date' => now(),
                ]);

                // Log the creation for debugging
                Log::info('New volunteer created from event application', [
                    'volunteer_id' => $newVolunteer->id,
                    'application_id' => $application->id,
                    'email' => $application->email
                ]);
            }

            // Create user account if it doesn't exist
            if (!$existingUser) {
                \App\Models\User::create([
                    'name' => $application->full_name,
                    'email' => $application->email,
                    'password' => Hash::make('volunteer123'), // Default password
                    'role' => 'volunteer',
                    'email_verified_at' => now(),
                ]);

                // Log the user creation for debugging
                Log::info('New user created from event application', [
                    'application_id' => $application->id,
                    'email' => $application->email
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Application status updated successfully',
            'status' => $request->status,
            'application' => $application
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
}
