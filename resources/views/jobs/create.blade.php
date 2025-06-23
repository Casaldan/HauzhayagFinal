<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Post Job - {{ config('app.name', 'Hauz Hayag') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3A5F6B',
                        secondary: '#2C5F6E',
                        neutral: '#f8fafc'
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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

        /* Card animations */
        .card-hover {
            transition: all 0.3s ease-in-out;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-gray-100 font-['Inter']">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <x-sidebar role="volunteer" currentRoute="{{ request()->route()->getName() ?? 'jobs' }}" />

        <!-- Main Content -->
        <div class="flex-1 ml-64 overflow-y-auto">
            <div class="p-8">
                <!-- Header -->
                <div class="bg-white p-6 flex justify-between items-center shadow-sm rounded-lg mb-8">
                    <div>
                        <h2 class="text-2xl font-bold flex items-center text-gray-800">
                            <svg class="w-7 h-7 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            POST A JOB
                        </h2>
                        <p class="text-gray-600 mt-1">Create a new job listing for review</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('volunteer.dashboard') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-opacity-90 transition-all duration-300 hover-scale flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Back to Dashboard
                        </a>
                        <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </div>
                </div>

    <!-- Job Creation Form -->
    <div class="bg-white rounded-xl shadow-lg p-8 card-hover">
        <div class="mb-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Job Details</h3>
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-4">
                <div class="flex items-center">
                    <div class="bg-blue-100 rounded-full p-2 mr-3">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-blue-800">Review Process</p>
                        <p class="text-xs text-blue-600">Your job posting will be reviewed by admin before being published.</p>
                    </div>
                </div>
            </div>
        </div>
        @if ($errors->any())
            <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded-lg shadow">
                <div class="flex">
                    <svg class="h-5 w-5 text-red-400 mr-3 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <h3 class="text-sm font-medium text-red-800">Please fix the following errors:</h3>
                        <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('volunteer.jobs.store') }}" method="POST" class="space-y-8">
            @csrf

            <!-- Basic Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="form-group">
                    <label class="block text-xs font-medium text-gray-700 mb-2">Job Title <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input type="text" name="title" class="w-full px-3 py-2 pl-8 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-100 focus:border-teal-400 transition-all duration-300 bg-gray-50 hover:bg-white text-sm" required value="{{ old('title') }}" placeholder="e.g. Software Developer">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-2">
                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2m-8 0V6a2 2 0 00-2 2v6"/>
                            </svg>
                        </div>
                    </div>
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="block text-xs font-medium text-gray-700 mb-2">Company Name <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input type="text" name="company_name" class="w-full px-3 py-2 pl-8 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-100 focus:border-teal-400 transition-all duration-300 bg-gray-50 hover:bg-white text-sm" required value="{{ old('company_name') }}" placeholder="e.g. Tech Solutions Inc.">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-2">
                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                    </div>
                    @error('company_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="block text-sm font-semibold text-gray-700 mb-3">Role <span class="text-red-500">*</span></label>
                <div class="relative">
                    <input type="text" name="role" class="w-full px-4 py-3 pl-12 border border-gray-200 rounded-xl focus:outline-none focus:ring-3 focus:ring-teal-100 focus:border-teal-400 transition-all duration-300 bg-gray-50 hover:bg-white" required value="{{ old('role') }}" placeholder="e.g. Full Stack Developer">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                </div>
                @error('role')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="block text-sm font-semibold text-gray-700 mb-3">Description <span class="text-red-500">*</span></label>
                <div class="relative">
                    <textarea name="description" class="w-full px-4 py-3 pl-12 border border-gray-200 rounded-xl focus:outline-none focus:ring-3 focus:ring-teal-100 focus:border-teal-400 transition-all duration-300 bg-gray-50 hover:bg-white resize-none" rows="4" required placeholder="Describe the job responsibilities and requirements...">{{ old('description') }}</textarea>
                    <div class="absolute top-3 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="block text-sm font-semibold text-gray-700 mb-3">Qualifications <span class="text-red-500">*</span></label>
                <div class="relative">
                    <textarea name="qualifications" class="w-full px-4 py-3 pl-12 border border-gray-200 rounded-xl focus:outline-none focus:ring-3 focus:ring-teal-100 focus:border-teal-400 transition-all duration-300 bg-gray-50 hover:bg-white resize-none" rows="3" required placeholder="List the required qualifications and skills...">{{ old('qualifications') }}</textarea>
                    <div class="absolute top-3 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </div>
                </div>
                @error('qualifications')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
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

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4 pt-8 border-t border-gray-100">
                <a href="{{ route('volunteer.dashboard') }}" class="group bg-gray-100 hover:bg-gray-200 text-gray-700 px-8 py-3 rounded-xl font-medium transition-all duration-300 btn-hover flex items-center">
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
        </div>
    </div>

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
</body>
</html>