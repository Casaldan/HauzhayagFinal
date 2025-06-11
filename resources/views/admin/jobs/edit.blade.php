@extends('layouts.admin')

@push('styles')
<style>
    /* Enhanced hover effects for form elements */
    .form-input:focus {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* Enhanced button hover effects */
    .btn-hover:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* Smooth transitions for all interactive elements */
    .transition-all {
        transition: all 0.3s ease-in-out;
    }
</style>
@endpush

@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="bg-white p-4 flex justify-between items-center shadow-sm rounded-lg mb-6">
        <h2 class="text-xl flex items-center">
            <svg class="w-6 h-6 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Edit Job Listing
        </h2>
        <div class="flex items-center space-x-3">
            <span class="text-gray-600">Admin</span>
            <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white font-medium">
                AD
            </div>
        </div>
    </div>

    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Job: {{ $job->title }}</h1>
        <p class="text-gray-600">Update job posting details</p>
    </div>

    <!-- Job Edit Form -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-semibold text-gray-800">Job Details</h3>
            <a href="{{ route('admin.jobs.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-all btn-hover">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Jobs
            </a>
        </div>
            <form action="{{ route('admin.jobs.update', $job) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Job Title -->
                    <div class="form-group">
                        <label for="title" class="block text-sm font-medium text-gray-700">Job Title <span class="text-red-500">*</span></label>
                        <input type="text" id="title" name="title" value="{{ old('title', $job->title) }}" required class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('title') border-red-500 @enderror">
                        @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <!-- Company Name -->
                    <div class="form-group">
                        <label for="company_name" class="block text-sm font-medium text-gray-700">Company Name <span class="text-red-500">*</span></label>
                        <input type="text" id="company_name" name="company_name" value="{{ old('company_name', $job->company_name) }}" required class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('company_name') border-red-500 @enderror">
                        @error('company_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Role -->
                    <div class="form-group">
                        <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                        <input type="text" id="role" name="role" value="{{ old('role', $job->role) }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('role') border-red-500 @enderror">
                        @error('role')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <!-- Employment Type -->
                    <div class="form-group">
                        <label for="employment_type" class="block text-sm font-medium text-gray-700">Employment Type</label>
                        <select id="employment_type" name="employment_type" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('employment_type') border-red-500 @enderror">
                            <option value="">Select Employment Type</option>
                            <option value="full-time" {{ old('employment_type', $job->employment_type) == 'full-time' ? 'selected' : '' }}>Full-time</option>
                            <option value="part-time" {{ old('employment_type', $job->employment_type) == 'part-time' ? 'selected' : '' }}>Part-time</option>
                            <option value="contract" {{ old('employment_type', $job->employment_type) == 'contract' ? 'selected' : '' }}>Contract</option>
                            <option value="temporary" {{ old('employment_type', $job->employment_type) == 'temporary' ? 'selected' : '' }}>Temporary</option>
                            <option value="internship" {{ old('employment_type', $job->employment_type) == 'internship' ? 'selected' : '' }}>Internship</option>
                        </select>
                        @error('employment_type')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description <span class="text-red-500">*</span></label>
                    <textarea id="description" name="description" rows="4" required class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('description') border-red-500 @enderror">{{ old('description', $job->description) }}</textarea>
                    @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Qualifications -->
                <div class="form-group">
                    <label for="qualifications" class="block text-sm font-medium text-gray-700">Qualifications <span class="text-red-500">*</span></label>
                    <textarea id="qualifications" name="qualifications" rows="4" required class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('qualifications') border-red-500 @enderror">{{ old('qualifications', $job->qualifications) }}</textarea>
                    @error('qualifications')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Location -->
                    <div class="form-group">
                        <label for="location" class="block text-sm font-medium text-gray-700">Location <span class="text-red-500">*</span></label>
                        <input type="text" id="location" name="location" value="{{ old('location', $job->location) }}" required class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('location') border-red-500 @enderror">
                        @error('location')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <!-- Category -->
                    <div class="form-group">
                        <label for="category" class="block text-sm font-medium text-gray-700">Category <span class="text-red-500">*</span></label>
                        <select id="category" name="category" required class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('category') border-red-500 @enderror">
                            <option value="">Select Category</option>
                            <option value="technology" {{ old('category', $job->category) == 'technology' ? 'selected' : '' }}>Technology</option>
                            <option value="healthcare" {{ old('category', $job->category) == 'healthcare' ? 'selected' : '' }}>Healthcare</option>
                            <option value="education" {{ old('category', $job->category) == 'education' ? 'selected' : '' }}>Education</option>
                            <option value="finance" {{ old('category', $job->category) == 'finance' ? 'selected' : '' }}>Finance</option>
                            <option value="marketing" {{ old('category', $job->category) == 'marketing' ? 'selected' : '' }}>Marketing</option>
                            <option value="event-management" {{ old('category', $job->category) == 'event-management' ? 'selected' : '' }}>Event Management</option>
                            <option value="other" {{ old('category', $job->category) == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('category')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Start Date -->
                    <div class="form-group">
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                        <input type="date" id="start_date" name="start_date" value="{{ old('start_date', $job->start_date) }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('start_date') border-red-500 @enderror">
                        @error('start_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <!-- End Date -->
                    <div class="form-group">
                        <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                        <input type="date" id="end_date" name="end_date" value="{{ old('end_date', $job->end_date) }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('end_date') border-red-500 @enderror">
                        @error('end_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <!-- Requirements -->
                <div class="form-group">
                    <label for="requirements" class="block text-sm font-medium text-gray-700">Requirements</label>
                    <textarea id="requirements" name="requirements" rows="3" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('requirements') border-red-500 @enderror">{{ old('requirements', $job->requirements) }}</textarea>
                    @error('requirements')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Benefits -->
                <div class="form-group">
                    <label for="benefits" class="block text-sm font-medium text-gray-700">Benefits</label>
                    <textarea id="benefits" name="benefits" rows="3" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('benefits') border-red-500 @enderror">{{ old('benefits', $job->benefits) }}</textarea>
                    @error('benefits')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Contact Email -->
                    <div class="form-group">
                        <label for="contact_email" class="block text-sm font-medium text-gray-700">Contact Email <span class="text-red-500">*</span></label>
                        <input type="email" id="contact_email" name="contact_email" value="{{ old('contact_email', $job->contact_email) }}" required class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('contact_email') border-red-500 @enderror">
                        @error('contact_email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <!-- Contact Phone -->
                    <div class="form-group">
                        <label for="contact_phone" class="block text-sm font-medium text-gray-700">Contact Phone</label>
                        <input type="text" id="contact_phone" name="contact_phone" value="{{ old('contact_phone', $job->contact_phone) }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('contact_phone') border-red-500 @enderror">
                        @error('contact_phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <!-- Contact Person -->
                    <div class="form-group">
                        <label for="contact_person" class="block text-sm font-medium text-gray-700">Contact Person <span class="text-red-500">*</span></label>
                        <input type="text" id="contact_person" name="contact_person" value="{{ old('contact_person', $job->contact_person) }}" required class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('contact_person') border-red-500 @enderror">
                        @error('contact_person')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Salary Min -->
                    <div class="form-group">
                        <label for="salary_min" class="block text-sm font-medium text-gray-700">Minimum Salary</label>
                        <input type="number" id="salary_min" name="salary_min" value="{{ old('salary_min', $job->salary_min) }}" min="0" step="0.01" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('salary_min') border-red-500 @enderror">
                        @error('salary_min')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <!-- Salary Max -->
                    <div class="form-group">
                        <label for="salary_max" class="block text-sm font-medium text-gray-700">Maximum Salary</label>
                        <input type="number" id="salary_max" name="salary_max" value="{{ old('salary_max', $job->salary_max) }}" min="0" step="0.01" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('salary_max') border-red-500 @enderror">
                        @error('salary_max')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Status -->
                    <div class="form-group">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status <span class="text-red-500">*</span></label>
                        <select id="status" name="status" required class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('status') border-red-500 @enderror">
                            <option value="">Select Status</option>
                            <option value="pending" {{ old('status', $job->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ old('status', $job->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ old('status', $job->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                        @error('status')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <!-- Expires At -->
                    <div class="form-group">
                        <label for="expires_at" class="block text-sm font-medium text-gray-700">Expires At</label>
                        <input type="datetime-local" id="expires_at" name="expires_at" value="{{ old('expires_at', $job->expires_at ? $job->expires_at->format('Y-m-d\TH:i') : '') }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('expires_at') border-red-500 @enderror">
                        @error('expires_at')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200 mt-8">
                    <a href="{{ route('admin.jobs.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition-all btn-hover">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Cancel
                    </a>
                    <button type="submit" class="bg-secondary text-white px-6 py-2 rounded-lg hover:bg-secondary/80 transition-all btn-hover">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Update Job Listing
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Form validation and enhancement
    document.addEventListener('DOMContentLoaded', function() {
        // Add form validation feedback
        const form = document.querySelector('form');
        const inputs = form.querySelectorAll('input, textarea, select');

        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.hasAttribute('required') && !this.value.trim()) {
                    this.classList.add('border-red-500');
                    this.classList.remove('border-gray-300');
                } else {
                    this.classList.remove('border-red-500');
                    this.classList.add('border-gray-300');
                }
            });
        });

        // Salary validation
        const salaryMin = document.getElementById('salary_min');
        const salaryMax = document.getElementById('salary_max');

        function validateSalary() {
            const min = parseFloat(salaryMin.value) || 0;
            const max = parseFloat(salaryMax.value) || 0;

            if (min > 0 && max > 0 && min > max) {
                salaryMax.setCustomValidity('Maximum salary must be greater than minimum salary');
            } else {
                salaryMax.setCustomValidity('');
            }
        }

        salaryMin.addEventListener('input', validateSalary);
        salaryMax.addEventListener('input', validateSalary);

        // Date validation
        const startDate = document.getElementById('start_date');
        const endDate = document.getElementById('end_date');

        function validateDates() {
            if (startDate.value && endDate.value && startDate.value > endDate.value) {
                endDate.setCustomValidity('End date must be after start date');
            } else {
                endDate.setCustomValidity('');
            }
        }

        startDate.addEventListener('change', validateDates);
        endDate.addEventListener('change', validateDates);
    });
</script>
@endpush

