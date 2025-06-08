@extends('layouts.app')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Create New Job Listing</h2>
            <a href="{{ route('admin.jobs.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                &#8592; Back to List
            </a>
        </div>
        <form action="{{ route('admin.jobs.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="form-group">
                <label for="title" class="block text-sm font-medium text-gray-700">Job Title <span class="text-red-500">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 @error('title') border-red-500 @enderror">
                @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label for="company_name" class="block text-sm font-medium text-gray-700">Company Name <span class="text-red-500">*</span></label>
                <input type="text" id="company_name" name="company_name" value="{{ old('company_name') }}" required class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 @error('company_name') border-red-500 @enderror">
                @error('company_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label for="role" class="block text-sm font-medium text-gray-700">Role <span class="text-red-500">*</span></label>
                <input type="text" id="role" name="role" value="{{ old('role') }}" required class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 @error('role') border-red-500 @enderror">
                @error('role')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="contact_person" class="block text-sm font-medium text-gray-700">Contact Person <span class="text-red-500">*</span></label>
                    <input type="text" id="contact_person" name="contact_person" value="{{ old('contact_person') }}" required class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 @error('contact_person') border-red-500 @enderror">
                    @error('contact_person')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="contact_email" class="block text-sm font-medium text-gray-700">Contact Email <span class="text-red-500">*</span></label>
                    <input type="email" id="contact_email" name="contact_email" value="{{ old('contact_email') }}" required class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 @error('contact_email') border-red-500 @enderror">
                    @error('contact_email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="contact_phone" class="block text-sm font-medium text-gray-700">Contact Phone</label>
                    <input type="tel" id="contact_phone" name="contact_phone" value="{{ old('contact_phone') }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 @error('contact_phone') border-red-500 @enderror">
                    @error('contact_phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="mb-4">
                    <label for="location" class="block text-sm font-medium text-gray-700">Location <span class="text-red-500">*</span></label>
                    <input type="text" name="location" id="location" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('location') }}" required>
                    @error('location')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description <span class="text-red-500">*</span></label>
                <textarea id="description" name="description" rows="4" required class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="qualifications" class="block text-sm font-medium text-gray-700">Qualifications <span class="text-red-500">*</span></label>
                <textarea id="qualifications" name="qualifications" rows="4" required class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 @error('qualifications') border-red-500 @enderror">{{ old('qualifications') }}</textarea>
                @error('qualifications')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="employment_type" class="block text-sm font-medium text-gray-700">Employment Type <span class="text-red-500">*</span></label>
                    <select id="employment_type" name="employment_type" required class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 @error('employment_type') border-red-500 @enderror">
                        <option value="">Select Type</option>
                        <option value="Full-time" {{ old('employment_type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                        <option value="Part-time" {{ old('employment_type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                        <option value="Contract" {{ old('employment_type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                        <option value="Internship" {{ old('employment_type') == 'Internship' ? 'selected' : '' }}>Internship</option>
                    </select>
                    @error('employment_type')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="hours_per_week" class="block text-sm font-medium text-gray-700">Hours per Week</label>
                    <input type="number" id="hours_per_week" name="hours_per_week" value="{{ old('hours_per_week') }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 @error('hours_per_week') border-red-500 @enderror">
                    @error('hours_per_week')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="salary_min" class="block text-sm font-medium text-gray-700">Minimum Salary</label>
                    <input type="number" step="0.01" id="salary_min" name="salary_min" value="{{ old('salary_min') }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 @error('salary_min') border-red-500 @enderror">
                    @error('salary_min')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="salary_max" class="block text-sm font-medium text-gray-700">Maximum Salary</label>
                    <input type="number" step="0.01" id="salary_max" name="salary_max" value="{{ old('salary_max') }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 @error('salary_max') border-red-500 @enderror">
                    @error('salary_max')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700">Category <span class="text-red-500">*</span></label>
                    <select id="category" name="category" required class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 @error('category') border-red-500 @enderror">
                        <option value="">Select Category</option>
                        <option value="event management" {{ old('category') == 'event management' ? 'selected' : '' }}>Event Management</option>
                        <option value="education" {{ old('category') == 'education' ? 'selected' : '' }}>Education</option>
                        <option value="healthcare" {{ old('category') == 'healthcare' ? 'selected' : '' }}>Healthcare</option>
                        <option value="technology" {{ old('category') == 'technology' ? 'selected' : '' }}>Technology</option>
                    </select>
                    @error('category')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="expires_at" class="block text-sm font-medium text-gray-700">Expiry Date</label>
                    <input type="date" id="expires_at" name="expires_at" value="{{ old('expires_at') }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 @error('expires_at') border-red-500 @enderror">
                    @error('expires_at')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="form-group">
                <label for="status" class="block text-sm font-medium text-gray-700">Status <span class="text-red-500">*</span></label>
                <select id="status" name="status" required class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 @error('status') border-red-500 @enderror">
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
                @error('status')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.jobs.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-semibold text-lg shadow hover:bg-gray-300 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-8 py-3 bg-green-600 text-white rounded-lg font-bold text-lg shadow-lg hover:bg-green-700 transition-colors transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2">
                    Create Job
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
@endsection


