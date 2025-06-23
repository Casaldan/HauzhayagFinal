<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobListing;
use Carbon\Carbon;

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

        // Allow access if:
        // 1. Job is approved (public access)
        // 2. User is admin (can view all jobs)
        // 3. User is the volunteer who posted the job (can view their own pending jobs)
        $canView = $job->status === 'approved' ||
                   (auth()->check() && auth()->user()->is_admin) ||
                   (auth()->check() && $job->posted_by == auth()->id());

        if (!$canView) {
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
        // Check if this is an admin request (from admin routes)
        if (request()->is('admin/*')) {
            return view('admin.jobs.create');
        }

        // Default to volunteer job creation view
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
            'contact_email' => ['required', 'email', 'max:255'],
            'contact_phone' => ['required', 'string', 'regex:/^\d{11}$/'],
            'expires_at' => 'required|date|after:today',
            'category' => 'required|string|max:255',
        ], [

            'contact_phone.required' => 'Contact phone number is required.',
            'contact_phone.regex' => 'Contact phone number must be exactly 11 digits.',
            'expires_at.required' => 'The expiry date is required.',
            'expires_at.after' => 'The expiry date must be a future date.'
        ]);

        $validated['status'] = 'pending';
        $validated['is_admin_posted'] = false;
        $validated['posted_by'] = auth()->id();
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
            'role' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'employment_type' => 'nullable|string|max:255',
            'qualifications' => 'nullable|string',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gte:salary_min',
            'contact_person' => 'nullable|string|max:255',
            'contact_email' => ['nullable', 'email', 'max:255'],
            'contact_phone' => ['required', 'string', 'regex:/^\d{11}$/'],
            'expires_at' => 'required|date|after:today',
            'category' => 'nullable|string|max:255',
            'status' => 'nullable|string|in:pending,approved,rejected',
        ], [
            'contact_phone.required' => 'Contact phone number is required.',
            'contact_phone.regex' => 'Contact phone number must be exactly 11 digits.'
        ]);

        // Set default status if not provided
        $validated['status'] = $validated['status'] ?? 'approved'; // Admin jobs are auto-approved by default
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
            'contact_email' => ['required', 'email', 'max:255'],
            'contact_phone' => ['required', 'string', 'regex:/^\d{11}$/'],
            'contact_person' => 'required|string|max:255',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gte:salary_min',
            'expires_at' => 'required|date|after:today',
        ], [
            'contact_phone.required' => 'Contact phone number is required.',
            'contact_phone.regex' => 'Contact phone number must be exactly 11 digits.',
            'expires_at.required' => 'The expiry date is required.',
            'expires_at.after' => 'The expiry date must be a future date.'
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

    public function importCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048'
        ]);

        try {
            $file = $request->file('csv_file');
            $path = $file->getRealPath();
            $handle = fopen($path, 'r');

            // Read header row
            $header = fgetcsv($handle);

            $imported = 0;
            $errors = [];

            while (($row = fgetcsv($handle)) !== false) {
                try {
                    $data = array_combine($header, $row);

                    // Prepare job data for volunteer submission (pending status)
                    $jobData = $this->prepareVolunteerJobDataFromCsv($data);

                    JobListing::create($jobData);
                    $imported++;

                } catch (\Exception $e) {
                    $errors[] = "Row error: " . $e->getMessage();
                }
            }

            fclose($handle);

            $message = "Successfully imported {$imported} job listings for admin review.";
            if (count($errors) > 0) {
                $message .= " " . count($errors) . " errors encountered.";
            }

            return redirect()->route('volunteer.jobs.create')
                ->with('success', $message);

        } catch (\Exception $e) {
            return redirect()->route('volunteer.jobs.create')
                ->with('error', 'Import failed: ' . $e->getMessage());
        }
    }

    public function downloadTemplate()
    {
        $headers = [
            'title',
            'company_name',
            'role',
            'description',
            'qualifications',
            'employment_type',
            'location',
            'category',
            'contact_person',
            'contact_email',
            'contact_phone',
            'salary_min',
            'salary_max',
            'expires_at',
            'benefits',
            'requirements'
        ];

        $filename = 'volunteer_job_listings_template.csv';
        $handle = fopen('php://output', 'w');

        // Set headers for download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // Write CSV header
        fputcsv($handle, $headers);

        // Write sample data
        fputcsv($handle, [
            'Community Volunteer Coordinator',
            'Local NGO Foundation',
            'Volunteer Coordinator',
            'Coordinate volunteer activities and community outreach programs...',
            'Bachelor\'s degree preferred, Strong communication skills, Experience in community work',
            'Part-time',
            'Cebu City, Philippines',
            'Community Service',
            'Maria Santos',
            'hr@localngo.gmail.com',
            '09171234567',
            '15000',
            '25000',
            '2024-12-31',
            'Flexible hours, Community impact, Training provided',
            'Passion for community service, Team collaboration'
        ]);

        fputcsv($handle, [
            'Social Media Assistant',
            'Community Center',
            'Social Media Assistant',
            'Help manage social media accounts and create content for community programs...',
            'Social media experience, Creative writing skills, Basic graphic design knowledge',
            'Part-time',
            'Makati City, Philippines',
            'Marketing',
            'John Cruz',
            'admin@communitycenter.gmail.com',
            '09181234567',
            '12000',
            '20000',
            '2024-11-30',
            'Remote work options, Skill development, Portfolio building',
            'Social media knowledge, Content creation skills'
        ]);

        fclose($handle);
        exit;
    }

    private function prepareVolunteerJobDataFromCsv($data)
    {
        return [
            'title' => $data['title'] ?? 'Untitled Position',
            'company_name' => $data['company_name'] ?? 'Unknown Organization',
            'role' => $data['role'] ?? $data['title'] ?? 'General Role',
            'description' => $data['description'] ?? 'No description provided',
            'qualifications' => $data['qualifications'] ?? 'To be discussed',
            'employment_type' => $data['employment_type'] ?? 'Part-time',
            'type' => $data['employment_type'] ?? 'Part-time',
            'location' => $data['location'] ?? 'Remote',
            'category' => $data['category'] ?? 'Community Service',
            'contact_person' => $data['contact_person'] ?? 'Contact Person',
            'contact_email' => $data['contact_email'] ?? 'contact@organization.gmail.com',
            'contact_phone' => $data['contact_phone'] ?? null,
            'salary_min' => !empty($data['salary_min']) ? (float)$data['salary_min'] : null,
            'salary_max' => !empty($data['salary_max']) ? (float)$data['salary_max'] : null,
            'expires_at' => !empty($data['expires_at']) ? Carbon::parse($data['expires_at']) : Carbon::now()->addMonths(2),
            'benefits' => $data['benefits'] ?? null,
            'requirements' => $data['requirements'] ?? null,
            'status' => 'pending', // All volunteer imports are pending
            'is_admin_posted' => false, // Volunteer posted
            'posted_by' => auth()->id(),
        ];
    }

}
