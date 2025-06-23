<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use App\Models\VolunteerHour;
use Carbon\Carbon;
use App\Models\JobListing;
use Illuminate\Support\Facades\Validator;
use App\Models\Volunteer;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class VolunteerController extends Controller
{
    public function index()
    {
        // Logic to retrieve volunteers data
        $volunteers = Volunteer::all();
        return view('volunteers.index', compact('volunteers'));
    }

    public function dashboard()
    {
        try {
            // Load only admin-posted and active events
            $events = Event::where('status', 'active')
                          ->where('is_admin_posted', true)
                          ->where('end_date', '>', now())
                          ->get();
            
            // Load all jobs for the job listings section
            $allJobs = JobListing::orderBy('created_at', 'desc')->get();

            // Calculate volunteer hours
            $currentMonth = now()->month;
            $currentYear = now()->year;
            $volunteerId = auth()->id();

            $hoursThisMonth = \App\Models\VolunteerHour::where('volunteer_id', $volunteerId)
                ->whereMonth('date', $currentMonth)
                ->whereYear('date', $currentYear)
                ->sum('hours');

            $totalHours = \App\Models\VolunteerHour::where('volunteer_id', $volunteerId)
                ->sum('hours');

            $recentActivities = \App\Models\VolunteerHour::with('event')
                ->where('volunteer_id', $volunteerId)
                ->orderBy('date', 'desc')
                ->take(5)
                ->get();

            return view('volunteers.volunteerdashboard', compact(
                'events', 'allJobs', 'hoursThisMonth', 'totalHours', 'recentActivities'
            ));
        } catch (\Exception $e) {
            \Log::error('Volunteer Dashboard Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the dashboard.');
        }
    }



    /**
     * Store a newly created volunteer in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:volunteers'],
            'phone' => ['required', 'string', 'regex:/^\d{11}$/'],
            'skills' => 'nullable|array',
            'status' => 'required|in:Active,Pending,Inactive',
            'notes' => 'nullable|string',
            'start_date' => 'required|date',
        ], [

            'phone.regex' => 'Phone number must be exactly 11 digits.'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation error', 'errors' => $validator->errors()], 422);
        }

        try {
            // Create the volunteer
            $volunteer = Volunteer::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'skills' => $request->skills ? json_encode($request->skills) : null,
                'status' => $request->status,
                'notes' => $request->notes,
                'start_date' => $request->start_date,
            ]);

            return response()->json([
                'message' => 'Volunteer created successfully',
                'id' => $volunteer->id,
                'volunteer' => $volunteer
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create volunteer', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the volunteer's status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $id)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:Active,Pending,Inactive',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation error', 'errors' => $validator->errors()], 422);
        }

        try {
            // Find the volunteer
            $volunteer = Volunteer::findOrFail($id);
            
            // Update the status
            $volunteer->status = $request->status;
            $volunteer->save();

            return response()->json([
                'message' => 'Volunteer status updated successfully',
                'volunteer' => $volunteer
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update volunteer status', 'error' => $e->getMessage()], 500);
        }
    }

    public function viewCalendar()
    {
        // Logic for viewing calendar
        return view('volunteer.calendar');
    }

    public function addJobOffer(Request $request)
    {
        // Logic for adding job offers
        // Implement validation and job offer creation
        return back()->with('success', 'Job offer added successfully');
    }



    /**
     * Remove the specified volunteer from storage.
     *
     * @param  \App\Models\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Volunteer $volunteer)
    {
        try {
            $volunteer->delete();
            return response()->json(['message' => 'Volunteer deleted successfully']);
        } catch (\Exception $e) {
            Log::error('Failed to delete volunteer:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['message' => 'Failed to delete volunteer', 'error' => $e->getMessage()], 500);
        }
    }

    public function jobs()
    {
        // Fetch all approved job listings for volunteers to view
        $jobs = JobListing::where('status', 'approved')
            ->latest()
            ->get();

        // Get unique companies and locations for filtering
        $companies = JobListing::where('status', 'approved')
            ->whereNotNull('company_name')
            ->distinct()
            ->pluck('company_name');

        $locations = JobListing::where('status', 'approved')
            ->whereNotNull('location')
            ->distinct()
            ->pluck('location');

        return view('volunteer.jobs', compact('jobs', 'companies', 'locations'));
    }

    public function events()
    {
        $events = \App\Models\Event::where('status', 'active')
            ->where('is_admin_posted', true)
            ->where('end_date', '>', now())
            ->orderBy('start_date', 'asc')
            ->get();

        // Get user's existing applications for these events
        $userApplications = [];
        if (auth()->check()) {
            $userApplications = \App\Models\VolunteerEventApplication::where('email', auth()->user()->email)
                ->whereIn('event_id', $events->pluck('id'))
                ->pluck('event_id')
                ->toArray();
        }

        return view('volunteer.events', compact('events', 'userApplications'));
    }

    public function showEvent($id)
    {
        $event = \App\Models\Event::findOrFail($id);
        return view('volunteers.event_show', compact('event'));
    }

    public function showApplicationForm(\App\Models\Event $event)
    {
        return view('volunteers.event_application_form', compact('event'));
    }


}
