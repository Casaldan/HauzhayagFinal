<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobListing;

class JobListingController extends Controller
{
    public function index(Request $request)
    {
        $query = JobListing::query();

        // Always filter to only approved jobs for public/volunteer listing
        $query->where('status', 'approved');

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%")
                  ->orWhere('role', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        // Company filter
        if ($request->has('company') && $request->company !== '') {
            $query->where('company_name', $request->company);
        }

        // Location filter
        if ($request->has('location') && $request->location !== '') {
            $query->where('location', 'LIKE', '%' . $request->location . '%');
        }

        // For volunteer/public view, use the correct view and pass companies/locations for filters
        $companies = JobListing::where('status', 'approved')
            ->whereNotNull('company_name')
            ->distinct()
            ->pluck('company_name')
            ->merge(
                JobListing::where('status', 'approved')
                    ->whereNull('company_name')
                    ->whereNotNull('company')
                    ->distinct()
                    ->pluck('company')
            )
            ->filter()
            ->unique();

        $locations = JobListing::where('status', 'approved')
            ->whereNotNull('location')
            ->distinct()
            ->pluck('location')
            ->filter()
            ->unique();

        $jobs = $query->latest()->paginate(10)->withQueryString();

        return view('jobs.listings', compact('jobs', 'companies', 'locations'));
    }

    public function show(JobListing $job)
    {
        // Debug: dump the current user
        \Log::info('Current user:', ['user' => auth()->user()]);
        if ($job->status !== 'approved' && (!auth()->check() || !auth()->user()->is_admin)) {
            abort(404);
        }
        // If the user is a volunteer, show the volunteer view
        if (auth()->check() && !auth()->user()->is_admin) {
            return view('volunteers.job_show', compact('job'));
        }
        // Default to the main job details view
        return view('jobs.show', compact('job'));
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'description' => 'required|string',
            'qualifications' => 'required|string',
            'employment_type' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gt:salary_min',
            'contact_person' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'nullable|string|max:255',
            'expires_at' => 'nullable|date',
            'category' => 'required|string|max:255',
        ]);

        $validated['status'] = 'pending';
        $validated['is_admin_posted'] = false;
        $validated['type'] = $validated['employment_type'] ?? null;
        $validated['location'] = trim($validated['location']);
        
        JobListing::create($validated);
        
        return redirect()->route('volunteer.dashboard')
            ->with('success', 'Job listing submitted and is pending admin approval.');
    }

    public function adminIndex()
    {
        $jobs = JobListing::latest()->get();
        return view('admin.jobs.index', compact('jobs'));
    }

    public function adminStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'company_name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'employment_type' => 'nullable|string|max:255',
            'qualifications' => 'nullable|string',
            'minimum_salary' => 'nullable|numeric|min:0',
            'maximum_salary' => 'nullable|numeric|min:0',
            'contact_person' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:255',
            'expiry_date' => 'nullable|date|after:today',
            'category' => 'nullable|string|max:255',
        ]);

        $validated['status'] = 'approved'; // Admin jobs are auto-approved
        $validated['is_admin_posted'] = true;
        $validated['posted_by'] = auth()->id();

        JobListing::create($validated);

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job listing created successfully!');
    }

    public function approve(JobListing $job)
    {
        $job->update(['status' => 'approved']);
        return redirect()->route('admin.jobs.index')->with('success', 'Job approved successfully!');
    }

    public function reject(JobListing $job)
    {
        $job->update(['status' => 'rejected']);
        return redirect()->route('admin.jobs.index')->with('success', 'Job rejected successfully!');
    }

    public function edit(JobListing $job)
    {
        return view('admin.jobs.edit', compact('job'));
    }

    public function update(Request $request, JobListing $job)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'description' => 'required|string',
            'qualifications' => 'required|string',
            'location' => 'required|string|max:255',
            'employment_type' => 'nullable|string|max:255',
            'category' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'nullable|string|max:255',
            'contact_person' => 'required|string|max:255',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gte:salary_min',
            'expires_at' => 'nullable|date',
        ]);

        $validated['location'] = trim($validated['location']);
        $job->update($validated);
        return redirect()->route('admin.jobs.index')->with('success', 'Job updated successfully!');
    }

    public function destroy(JobListing $job)
    {
        $job->delete();
        return redirect()->route('admin.jobs.index')->with('success', 'Job deleted successfully!');
    }


}
