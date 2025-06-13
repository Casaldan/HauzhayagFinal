<?php

namespace App\Http\Controllers;

use App\Models\VolunteerApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class VolunteerApplicationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'full_name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', 'regex:/@gmail\./i'],
            'phone_number' => ['required', 'string', 'regex:/^\d{11}$/'],
            'address' => 'required|string',
            'reason' => 'required|string',
        ], [
            'email.regex' => 'Email must be a Gmail address (must contain @gmail).',
            'phone_number.regex' => 'Phone number must be exactly 11 digits.'
        ]);

        $application = VolunteerApplication::create($validated);

        // Redirect to a generic success page
        return redirect()->route('volunteer.success');
    }

    public function index()
    {
        $applications = VolunteerApplication::with('event')->latest()->get();
        return view('admin.volunteer-applications.index', compact('applications'));
    }

    public function show(VolunteerApplication $application)
    {
        $application->load('event');
        return response()->json($application);
    }

    public function updateStatus(Request $request, VolunteerApplication $application)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected',
            'admin_notes' => 'nullable|string'
        ]);

        $application->update($validated);

        // If approved, create a new volunteer record and user account
        if ($validated['status'] === 'approved') {
            // Check if volunteer with this email already exists
            $existingVolunteer = \App\Models\Volunteer::where('email', $application->email)->first();

            // Check if user with this email already exists
            $existingUser = User::where('email', $application->email)->first();

            if (!$existingVolunteer) {
                $newVolunteer = \App\Models\Volunteer::create([
                    'name' => $application->full_name,
                    'email' => $application->email,
                    'phone' => $application->phone_number,
                    'skills' => json_encode(['Event Volunteer']), // Default skill
                    'status' => 'Active',
                    'notes' => 'Created from event application: ' . $application->event->title . '. Reason: ' . $application->reason,
                    'start_date' => now(),
                ]);

                // Log the volunteer creation for debugging
                Log::info('New volunteer created from application', [
                    'volunteer_id' => $newVolunteer->id,
                    'application_id' => $application->id,
                    'email' => $application->email
                ]);
            }

            // Create user account if it doesn't exist
            if (!$existingUser) {
                $newUser = User::create([
                    'name' => $application->full_name,
                    'email' => $application->email,
                    'password' => Hash::make('volunteer123'), // Default password
                    'role' => 'volunteer',
                    'status' => 'active', // Explicitly set status to active
                    'phone_number' => $application->phone_number, // Add phone number
                    'email_verified_at' => now(),
                ]);

                // Log the user creation for debugging
                Log::info('New user created from volunteer application', [
                    'user_id' => $newUser->id,
                    'application_id' => $application->id,
                    'email' => $application->email,
                    'role' => 'volunteer',
                    'status' => 'active'
                ]);
            }
        }

        return response()->json([
            'message' => 'Application status updated successfully',
            'application' => $application
        ]);
    }

    public function showSuccess()
    {
        return view('volunteer.success');
    }

    public function showTrackForm()
    {
        return view('volunteer.track');
    }

    public function track(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);

        $application = VolunteerApplication::where('email', $request->email)->first();

        return view('volunteer.track', compact('application'));
    }
}
