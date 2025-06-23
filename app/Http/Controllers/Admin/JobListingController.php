<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'contact_email' => ['required', 'email', 'max:255'],
            'contact_phone' => ['required', 'string', 'regex:/^\d{11}$/'],
            'contact_person' => 'required|string|max:255',
            'qualifications' => 'required|string',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0',
            'expires_at' => 'required|date|after:today',
            'status' => 'nullable|string|max:255',
        ], [
            'contact_phone.required' => 'Contact phone number is required.',
            'contact_phone.regex' => 'Contact phone number must be exactly 11 digits.',
            'expires_at.required' => 'The expiry date is required.',
            'expires_at.after' => 'The expiry date must be a future date.'
        ]);

        // Set default values for admin-created jobs
        $validated['status'] = $validated['status'] ?? 'approved';
        $validated['is_admin_posted'] = true;
        $validated['posted_by'] = auth()->id();
        $validated['type'] = $validated['employment_type'] ?? 'full-time';

        $job = JobListing::create($validated);

        return redirect()->route('admin.dashboard')
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
            'contact_email' => ['required', 'email', 'max:255'],
            'contact_phone' => ['required', 'string', 'regex:/^\d{11}$/'],
            'contact_person' => 'required|string|max:255',
            'qualifications' => 'required|string',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0',
            'expires_at' => 'required|date|after:today',
        ], [
            'contact_phone.required' => 'Contact phone number is required.',
            'contact_phone.regex' => 'Contact phone number must be exactly 11 digits.',
            'expires_at.required' => 'The expiry date is required.',
            'expires_at.after' => 'The expiry date must be a future date.'
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
}
