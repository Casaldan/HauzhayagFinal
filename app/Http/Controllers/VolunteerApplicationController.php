<?php

namespace App\Http\Controllers;

use App\Models\VolunteerApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VolunteerApplicationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string',
            'reason' => 'required|string',
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

        // If approved, create a new volunteer record
        if ($validated['status'] === 'approved') {
            // Check if volunteer with this email already exists
            $existingVolunteer = \App\Models\Volunteer::where('email', $application->email)->first();

            if (!$existingVolunteer) {
                \App\Models\Volunteer::create([
                    'name' => $application->full_name,
                    'email' => $application->email,
                    'phone' => $application->phone_number,
                    'skills' => json_encode(['Event Volunteer']), // Default skill
                    'status' => 'Active',
                    'notes' => 'Created from event application: ' . $application->event->title . '. Reason: ' . $application->reason,
                    'start_date' => now(),
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
