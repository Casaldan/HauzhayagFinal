<?php

namespace App\Http\Controllers;

use App\Models\VolunteerEventApplication;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class VolunteerEventApplicationController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'application_reason' => 'required|string|max:1000'
        ]);

        try {
            VolunteerEventApplication::create([
                'event_id' => $request->event_id,
                'full_name' => $request->full_name,
                'email' => $request->email,
                'application_reason' => $request->application_reason,
                'status' => 'pending'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Application submitted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to submit application. Please try again.'
            ], 500);
        }
    }

    public function index()
    {
        $applications = VolunteerEventApplication::with('event')
            ->orderBy('applied_at', 'desc')
            ->get();

        return view('admin.volunteer-applications.applications', compact('applications'));
    }

    public function updateStatus(Request $request, VolunteerEventApplication $application)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $application->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Application status updated successfully!');
    }
}
