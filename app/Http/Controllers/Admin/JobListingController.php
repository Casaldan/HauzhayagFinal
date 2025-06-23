<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class JobListingController extends Controller
{
    public function index()
    {
        $jobs = JobListing::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('admin.jobs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'role' => 'nullable|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'employment_type' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'category' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'contact_email' => ['required', 'email', 'max:255', 'regex:/@gmail\./i'],
            'contact_phone' => ['nullable', 'string', 'regex:/^\d{11}$/'],
            'contact_person' => 'required|string|max:255',
            'qualifications' => 'required|string',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0',
            'expires_at' => 'nullable|date',
            'status' => 'nullable|string|max:255',
        ], [
            'contact_email.regex' => 'Contact email must be a valid email address (must contain @gmail).',
            'contact_phone.regex' => 'Contact phone number must be exactly 11 digits.'
        ]);

        // Set default values for admin-created jobs
        $validated['status'] = $validated['status'] ?? 'approved';
        $validated['is_admin_posted'] = true;
        $validated['type'] = $validated['employment_type'] ?? 'full-time';

        $job = JobListing::create($validated);

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job listing created and approved successfully.');
    }

    public function show(JobListing $job)
    {
        return view('admin.jobs.show', compact('job'));
    }

    public function edit(JobListing $job)
    {
        return view('admin.jobs.edit', compact('job'));
    }

    public function update(Request $request, JobListing $job)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'role' => 'nullable|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'employment_type' => 'nullable|string|max:255',
            'status' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'contact_email' => ['required', 'email', 'max:255', 'regex:/@gmail\./i'],
            'contact_phone' => ['nullable', 'string', 'regex:/^\d{11}$/'],
            'contact_person' => 'required|string|max:255',
            'qualifications' => 'required|string',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0',
            'expires_at' => 'nullable|date',
        ], [
            'contact_email.regex' => 'Contact email must be a valid email address (must contain @gmail).',
            'contact_phone.regex' => 'Contact phone number must be exactly 11 digits.'
        ]);

        $job->update($validated);

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job listing updated successfully.');
    }

    public function destroy(JobListing $job)
    {
        $job->delete();
        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job listing deleted successfully.');
    }

    public function approve(JobListing $job)
    {
        $job->status = 'approved';
        $job->save();
        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job listing approved successfully.');
    }

    public function reject(JobListing $job)
    {
        $job->status = 'rejected';
        $job->save();
        return redirect()->route('admin.jobs.index')
            ->with('success', 'Job listing rejected successfully.');
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

                    // Prepare job data
                    $jobData = $this->prepareJobDataFromCsv($data);

                    JobListing::create($jobData);
                    $imported++;

                } catch (\Exception $e) {
                    $errors[] = "Row error: " . $e->getMessage();
                }
            }

            fclose($handle);

            $message = "Successfully imported {$imported} job listings.";
            if (count($errors) > 0) {
                $message .= " " . count($errors) . " errors encountered.";
            }

            return redirect()->route('admin.jobs.index')
                ->with('success', $message);

        } catch (\Exception $e) {
            return redirect()->route('admin.jobs.index')
                ->with('error', 'Import failed: ' . $e->getMessage());
        }
    }

    public function downloadTemplate()
    {
        $headers = [
            'title',
            'company_name',
            'description',
            'location',
            'employment_type',
            'category',
            'role',
            'qualifications',
            'contact_person',
            'contact_email',
            'contact_phone',
            'salary_min',
            'salary_max',
            'hours_per_week',
            'status',
            'benefits',
            'requirements'
        ];

        $filename = 'job_listings_template.csv';
        $handle = fopen('php://output', 'w');

        // Set headers for download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // Write CSV header
        fputcsv($handle, $headers);

        // Write sample data
        fputcsv($handle, [
            'Software Developer',
            'Tech Company Inc',
            'We are looking for a skilled software developer...',
            'Cebu City, Philippines',
            'Full-time',
            'Technology',
            'Software Developer',
            'Bachelor\'s degree in Computer Science, 3+ years experience',
            'John Doe',
            'hr@techcompany.gmail.com',
            '09171234567',
            '40000',
            '60000',
            '40',
            'approved',
            'Health insurance, 13th month pay',
            'Strong programming skills'
        ]);

        fclose($handle);
        exit;
    }

    private function prepareJobDataFromCsv($data)
    {
        return [
            'title' => $data['title'] ?? 'Untitled Position',
            'company_name' => $data['company_name'] ?? $data['company'] ?? 'Unknown Company',
            'description' => $data['description'] ?? 'No description provided',
            'location' => $data['location'] ?? 'Remote',
            'employment_type' => $data['employment_type'] ?? 'Full-time',
            'type' => $data['type'] ?? $data['employment_type'] ?? 'Full-time',
            'category' => $data['category'] ?? 'General',
            'role' => $data['role'] ?? $data['title'] ?? 'General Role',
            'qualifications' => $data['qualifications'] ?? 'To be discussed',
            'requirements' => $data['requirements'] ?? null,
            'benefits' => $data['benefits'] ?? null,
            'contact_person' => $data['contact_person'] ?? 'HR Department',
            'contact_email' => $data['contact_email'] ?? 'hr@company.gmail.com',
            'contact_phone' => $data['contact_phone'] ?? null,
            'salary_min' => !empty($data['salary_min']) ? (float)$data['salary_min'] : null,
            'salary_max' => !empty($data['salary_max']) ? (float)$data['salary_max'] : null,
            'hours_per_week' => $data['hours_per_week'] ?? '40',
            'start_date' => !empty($data['start_date']) ? Carbon::parse($data['start_date']) : null,
            'end_date' => !empty($data['end_date']) ? Carbon::parse($data['end_date']) : null,
            'expires_at' => !empty($data['expires_at']) ? Carbon::parse($data['expires_at']) : Carbon::now()->addMonths(3),
            'expiry_date' => !empty($data['expiry_date']) ? Carbon::parse($data['expiry_date']) : Carbon::now()->addMonths(3)->toDateString(),
            'status' => $data['status'] ?? 'approved',
            'is_admin_posted' => true,
            'posted_by' => auth()->id() ?? 1,
        ];
    }
}
