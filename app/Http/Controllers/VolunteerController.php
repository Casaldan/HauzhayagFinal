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

            // Load volunteer's events
            $myEvents = Event::where('posted_by', auth()->id())
                           ->where('is_admin_posted', false)
                           ->orderBy('created_at', 'desc')
                           ->get();

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
                'events', 'allJobs', 'hoursThisMonth', 'totalHours', 'recentActivities', 'myEvents'
            ));
        } catch (\Exception $e) {
            \Log::error('Volunteer Dashboard Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the dashboard.');
        }
    }

    public function jobPost()
    {
        // Fetch all approved job listings
        $jobs = JobListing::where('status', 'approved')
            ->where(function($query) {
                $query->whereNull('expires_at')
                      ->orWhere('expires_at', '>', now());
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('volunteers.volunteer_job_post', compact('jobs'));
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
            'email' => 'required|string|email|max:255|unique:volunteers',
            'phone' => 'required|string|max:20',
            'skills' => 'nullable|array',
            'status' => 'required|in:Active,Pending,Inactive',
            'notes' => 'nullable|string',
            'start_date' => 'required|date',
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
        return view('volunteers.calendar');
    }

    public function addJobOffer(Request $request)
    {
        // Logic for adding job offers
        // Implement validation and job offer creation
        return back()->with('success', 'Job offer added successfully');
    }

    public function storeJobPost(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'type' => 'required|string|in:Full-time,Part-time,Contract,Temporary,Internship',
            'employment_type' => 'required|string|in:Paid,Unpaid',
            'hours_per_week' => 'nullable|numeric',
            'category' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'salary_min' => 'nullable|numeric',
            'salary_max' => 'nullable|numeric|greater_than_field:salary_min',
            'contact_person' => 'required|string|max:255',
            'expires_at' => 'nullable|date|after_or_equal:today',
        ]);

        $job = JobListing::create([
            'title' => $request->title,
            'description' => $request->description,
            'company' => Auth::user()->name, // Assuming the logged-in user is the company/poster
            'company_name' => Auth::user()->name, // Assuming the logged-in user is the company/poster
            'location' => $request->location,
            'type' => $request->type,
            'employment_type' => $request->employment_type,
            'hours_per_week' => $request->hours_per_week,
            'status' => 'pending', // Jobs posted by volunteers might need admin approval
            'category' => $request->category,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'requirements' => $request->requirements,
            'benefits' => $request->benefits,
            'contact_email' => $request->contact_email,
            'contact_phone' => $request->contact_phone,
            'salary_min' => $request->salary_min,
            'salary_max' => $request->salary_max,
            'role' => $request->title, // Using title as a default for role if not provided
            'qualifications' => $request->requirements, // Using requirements as a default for qualifications if not provided
            'contact_person' => $request->contact_person,
            'expires_at' => $request->expires_at,
            'is_admin_posted' => false, // Mark as not admin posted
            'posted_by' => Auth::id(), // Record the user who posted it
        ]);

        // Redirect or return a response
        return redirect()->route('volunteer.dashboard')->with('success', 'Job post submitted successfully for review.');
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

    public function events()
    {
        $events = \App\Models\Event::where('status', 'active')
            ->where('is_admin_posted', true)
            ->where('end_date', '>', now())
            ->orderBy('start_date', 'asc')
            ->get();
        return view('volunteers.events', compact('events'));
    }

    public function showEvent($id)
    {
        $event = \App\Models\Event::findOrFail($id);
        return view('volunteers.event_show', compact('event'));
    }

    public function createJob()
    {
        return view('volunteers.job_create');
    }

    public function storeJob(Request $request)
    {
        $request->validate([
            'poster_name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'salary' => 'required|string|max:255',
            'description' => 'required|string',
            'qualifications' => 'required|string',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'contact_person' => 'required|string|max:255',
            'contact_link' => 'nullable|url|max:255',
            'category' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            // 'location' => 'required|string|max:255',
            // 'hours_per_week' => 'required|numeric|min:1',
        ]);

        $job = JobListing::create([
            'title' => $request->role,
            'description' => $request->description,
            'company' => $request->company_name,
            'company_name' => $request->company_name,
            'role' => $request->role,
            'salary_min' => null,
            'salary_max' => null,
            'status' => 'pending', // Needs admin approval
            'qualifications' => $request->qualifications,
            'contact_email' => $request->contact_email,
            'contact_phone' => $request->contact_phone,
            'contact_person' => $request->contact_person,
            'posted_by' => auth()->id(),
            'is_admin_posted' => false,
            'benefits' => null,
            'requirements' => null,
            'category' => $request->category,
            'type' => $request->type,
            'employment_type' => null,
            'start_date' => null,
            'end_date' => null,
            'expires_at' => null,
            'contact_link' => $request->contact_link,
            'salary' => $request->salary,
            // 'location' => $request->location,
        ]);

        return redirect()->route('volunteer.dashboard')->with('success', 'Job post submitted successfully for admin approval.');
    }

    public function jobListings()
    {
        $adminJobs = \App\Models\JobListing::where('is_admin_posted', true)
            ->where('status', 'approved')
            ->orderBy('created_at', 'desc')
            ->get();

        $myJobs = \App\Models\JobListing::where('posted_by', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('volunteers.job_listings', compact('adminJobs', 'myJobs'));
    }
}
