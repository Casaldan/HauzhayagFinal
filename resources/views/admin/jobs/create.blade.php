@extends('layouts.admin')

@push('styles')
<style>
    .form-group {
        position: relative;
    }

    .form-group input:focus + .absolute svg,
    .form-group textarea:focus + .absolute svg,
    .form-group select:focus + .absolute svg {
        color: #3b82f6;
        transform: scale(1.1);
    }

    .card-hover {
        transition: all 0.3s ease-in-out;
    }

    .card-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .btn-hover {
        transition: all 0.3s ease-in-out;
    }

    .btn-hover:hover {
        transform: translateY(-1px);
    }

    .btn-hover:active {
        transform: translateY(0);
    }

    /* Custom select dropdown styling */
    select {
        background-image: none;
    }

    /* Form field focus animations */
    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
        transform: translateY(-1px);
        box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.1), 0 4px 6px -2px rgba(59, 130, 246, 0.05);
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
                      d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            Post a Job
        </h2>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.dashboard') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-opacity-90 transition-all duration-300 flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Dashboard
            </a>
            <span class="text-gray-600">Admin</span>
            <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white font-medium">
                AD
            </div>
        </div>
    </div>

    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Post a Job</h1>
        <p class="text-gray-600">Create a new job posting for students and applicants</p>
    </div>

    <!-- Job Creation Form -->
    <div class="bg-white rounded-xl shadow-lg p-8 card-hover">
        <div class="mb-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Job Details</h3>
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-4">
                <div class="flex items-center">
                    <div class="bg-blue-100 rounded-full p-2 mr-3">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-blue-800">Admin Posting</p>
                        <p class="text-xs text-blue-600">Jobs posted by admin are automatically approved and published.</p>
                    </div>
                </div>
            </div>
        </div>
        <form action="{{ route('admin.jobs.store') }}" method="POST" class="space-y-8">
            @csrf

            <!-- Basic Information Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="form-group">
                    <label for="title" class="block text-xs font-medium text-gray-700 mb-2">Job Title <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input type="text" id="title" name="title" value="{{ old('title') }}" required
                               class="w-full px-3 py-2 pl-8 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-300 bg-gray-50 hover:bg-white text-sm @error('title') border-red-300 bg-red-50 @enderror">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-2">
                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2m-8 0V6a2 2 0 00-2 2v6"/>
                            </svg>
                        </div>
                    </div>
                    @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label for="company_name" class="block text-xs font-medium text-gray-700 mb-2">Company Name <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input type="text" id="company_name" name="company_name" value="{{ old('company_name') }}" required
                               class="w-full px-3 py-2 pl-8 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-300 bg-gray-50 hover:bg-white text-sm @error('company_name') border-red-300 bg-red-50 @enderror">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-2">
                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                    </div>
                    @error('company_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="form-group">
                <label for="role" class="block text-sm font-semibold text-gray-700 mb-3">Role <span class="text-red-500">*</span></label>
                <div class="relative">
                    <input type="text" id="role" name="role" value="{{ old('role') }}" required
                           class="w-full px-4 py-3 pl-12 border border-gray-200 rounded-xl focus:outline-none focus:ring-3 focus:ring-blue-100 focus:border-blue-400 transition-all duration-300 bg-gray-50 hover:bg-white @error('role') border-red-300 bg-red-50 @enderror">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                </div>
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
                    <label for="contact_phone" class="block text-sm font-medium text-gray-700">Contact Phone <span class="text-red-500">*</span></label>
                    <input type="tel" id="contact_phone" name="contact_phone" required value="{{ old('contact_phone') }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 @error('contact_phone') border-red-500 @enderror">
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

            <div class="form-group">
                <label for="employment_type" class="block text-sm font-medium text-gray-700">Employment Type</label>
                <select id="employment_type" name="employment_type" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 @error('employment_type') border-red-500 @enderror">
                    <option value="">Select Type (Optional)</option>
                    <option value="Full-time" {{ old('employment_type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                    <option value="Part-time" {{ old('employment_type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                    <option value="Contract" {{ old('employment_type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                    <option value="Internship" {{ old('employment_type') == 'Internship' ? 'selected' : '' }}>Internship</option>
                </select>
                @error('employment_type')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
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
                    <label for="expires_at" class="block text-sm font-medium text-gray-700">Expiry Date <span class="text-red-500">*</span></label>
                    <input type="date" id="expires_at" name="expires_at" required value="{{ old('expires_at') }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 @error('expires_at') border-red-500 @enderror">
                    @error('expires_at')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="form-group">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select id="status" name="status" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 @error('status') border-red-500 @enderror">
                    <option value="">Auto-approve (Default)</option>
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
                @error('status')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                <p class="text-sm text-gray-500 mt-1">Leave as default to auto-approve this job listing</p>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4 pt-8 border-t border-gray-100">
                <a href="{{ route('admin.jobs.index') }}" class="group bg-gray-100 hover:bg-gray-200 text-gray-700 px-8 py-3 rounded-xl font-medium transition-all duration-300 btn-hover flex items-center">
                    <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Cancel
                </a>
                <button type="submit" class="group bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white px-8 py-3 rounded-xl font-medium transition-all duration-300 btn-hover flex items-center shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    POST A JOB
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Enhanced form validation and animations
    document.addEventListener('DOMContentLoaded', function() {
        // Add form validation feedback with enhanced styling
        const form = document.querySelector('form');
        const inputs = form.querySelectorAll('input, textarea, select');

        inputs.forEach(input => {
            // Focus animations
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });

            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('focused');

                if (this.hasAttribute('required') && !this.value.trim()) {
                    this.classList.add('border-red-300', 'bg-red-50');
                    this.classList.remove('border-gray-200', 'bg-gray-50');
                } else {
                    this.classList.remove('border-red-300', 'bg-red-50');
                    this.classList.add('border-gray-200', 'bg-gray-50');
                }
            });

            // Input animations
            input.addEventListener('input', function() {
                if (this.value.trim()) {
                    this.classList.add('border-blue-300', 'bg-white');
                    this.classList.remove('border-gray-200', 'bg-gray-50');
                }
            });
        });

        // Staggered card animations on page load
        const cards = document.querySelectorAll('.card-hover');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            setTimeout(() => {
                card.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 150);
        });

        // Enhanced button click animations
        const buttons = document.querySelectorAll('.btn-hover');
        buttons.forEach(button => {
            button.addEventListener('mousedown', function() {
                this.style.transform = 'scale(0.98) translateY(1px)';
            });

            button.addEventListener('mouseup', function() {
                this.style.transform = '';
            });

            button.addEventListener('mouseleave', function() {
                this.style.transform = '';
            });
        });

        // Form submission animation
        form.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.innerHTML = `
                <svg class="w-5 h-5 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                Creating...
            `;
            submitBtn.disabled = true;
        });
    });
</script>
@endpush


