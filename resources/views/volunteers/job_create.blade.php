<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Add Job Listing - {{ config('app.name', 'Hauz Hayag') }}</title>
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
        <x-sidebar role="volunteer" currentRoute="{{ request()->route()->getName() ?? 'volunteer.jobs.create' }}" />

        <!-- Main Content -->
        <div class="flex-1 ml-64 overflow-y-auto">
            <div class="p-8">
                <!-- Header -->
                <div class="bg-white p-6 flex justify-between items-center shadow-sm rounded-lg mb-8">
                    <div>
                        <h2 class="text-2xl font-bold flex items-center text-gray-800">
                            <svg class="w-7 h-7 mr-3 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2M8 6v10a2 2 0 002 2h4a2 2 0 002-2V6"/>
                            </svg>
                            Add New Job Listing
                        </h2>
                        <p class="text-gray-600 mt-1">Create a new job opportunity for students and applicants</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('volunteer.jobs.listings') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-all duration-300 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            Back to Listings
                        </a>
                        <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </div>
                </div>

                <!-- Form Container -->
                <div class="bg-white rounded-xl shadow-lg p-8 card-hover">

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-6">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('volunteer.jobs.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Job Title -->
                        <div class="form-group">
                            <label for="title" class="block text-sm font-medium text-gray-700">Job Title <span class="text-red-500">*</span></label>
                            <input type="text" id="title" name="title" value="{{ old('title') }}" required class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('title') border-red-500 @enderror">
                            @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- Company Name -->
                        <div class="form-group">
                            <label for="company_name" class="block text-sm font-medium text-gray-700">Company Name <span class="text-red-500">*</span></label>
                            <input type="text" id="company_name" name="company_name" value="{{ old('company_name') }}" required class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('company_name') border-red-500 @enderror">
                            @error('company_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Role -->
                        <div class="form-group">
                            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                            <input type="text" id="role" name="role" value="{{ old('role') }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('role') border-red-500 @enderror">
                            @error('role')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- Employment Type -->
                        <div class="form-group">
                            <label for="employment_type" class="block text-sm font-medium text-gray-700">Employment Type</label>
                            <select id="employment_type" name="employment_type" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('employment_type') border-red-500 @enderror">
                                <option value="">Select Employment Type</option>
                                <option value="full-time" {{ old('employment_type') == 'full-time' ? 'selected' : '' }}>Full-time</option>
                                <option value="part-time" {{ old('employment_type') == 'part-time' ? 'selected' : '' }}>Part-time</option>
                                <option value="contract" {{ old('employment_type') == 'contract' ? 'selected' : '' }}>Contract</option>
                                <option value="temporary" {{ old('employment_type') == 'temporary' ? 'selected' : '' }}>Temporary</option>
                                <option value="internship" {{ old('employment_type') == 'internship' ? 'selected' : '' }}>Internship</option>
                            </select>
                            @error('employment_type')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description <span class="text-red-500">*</span></label>
                        <textarea id="description" name="description" rows="4" required class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                        @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <!-- Qualifications -->
                    <div class="form-group">
                        <label for="qualifications" class="block text-sm font-medium text-gray-700">Qualifications <span class="text-red-500">*</span></label>
                        <textarea id="qualifications" name="qualifications" rows="4" required class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('qualifications') border-red-500 @enderror">{{ old('qualifications') }}</textarea>
                        @error('qualifications')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Location -->
                        <div class="form-group">
                            <label for="location" class="block text-sm font-medium text-gray-700">Location <span class="text-red-500">*</span></label>
                            <input type="text" id="location" name="location" value="{{ old('location') }}" required class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('location') border-red-500 @enderror">
                            @error('location')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- Category -->
                        <div class="form-group">
                            <label for="category" class="block text-sm font-medium text-gray-700">Category <span class="text-red-500">*</span></label>
                            <select id="category" name="category" required class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('category') border-red-500 @enderror">
                                <option value="">Select Category</option>
                                <option value="technology" {{ old('category') == 'technology' ? 'selected' : '' }}>Technology</option>
                                <option value="healthcare" {{ old('category') == 'healthcare' ? 'selected' : '' }}>Healthcare</option>
                                <option value="education" {{ old('category') == 'education' ? 'selected' : '' }}>Education</option>
                                <option value="finance" {{ old('category') == 'finance' ? 'selected' : '' }}>Finance</option>
                                <option value="marketing" {{ old('category') == 'marketing' ? 'selected' : '' }}>Marketing</option>
                                <option value="event-management" {{ old('category') == 'event-management' ? 'selected' : '' }}>Event Management</option>
                                <option value="other" {{ old('category') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('category')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Start Date -->
                        <div class="form-group">
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                            <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('start_date') border-red-500 @enderror">
                            @error('start_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- End Date -->
                        <div class="form-group">
                            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                            <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('end_date') border-red-500 @enderror">
                            @error('end_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <!-- Requirements -->
                    <div class="form-group">
                        <label for="requirements" class="block text-sm font-medium text-gray-700">Requirements</label>
                        <textarea id="requirements" name="requirements" rows="3" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('requirements') border-red-500 @enderror">{{ old('requirements') }}</textarea>
                        @error('requirements')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <!-- Benefits -->
                    <div class="form-group">
                        <label for="benefits" class="block text-sm font-medium text-gray-700">Benefits</label>
                        <textarea id="benefits" name="benefits" rows="3" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('benefits') border-red-500 @enderror">{{ old('benefits') }}</textarea>
                        @error('benefits')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Contact Email -->
                        <div class="form-group">
                            <label for="contact_email" class="block text-sm font-medium text-gray-700">Contact Email <span class="text-red-500">*</span></label>
                            <input type="email" id="contact_email" name="contact_email" value="{{ old('contact_email') }}" required class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('contact_email') border-red-500 @enderror">
                            @error('contact_email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- Contact Phone -->
                        <div class="form-group">
                            <label for="contact_phone" class="block text-sm font-medium text-gray-700">Contact Phone</label>
                            <input type="text" id="contact_phone" name="contact_phone" value="{{ old('contact_phone') }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('contact_phone') border-red-500 @enderror">
                            @error('contact_phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- Contact Person -->
                        <div class="form-group">
                            <label for="contact_person" class="block text-sm font-medium text-gray-700">Contact Person <span class="text-red-500">*</span></label>
                            <input type="text" id="contact_person" name="contact_person" value="{{ old('contact_person') }}" required class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('contact_person') border-red-500 @enderror">
                            @error('contact_person')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Salary Min -->
                        <div class="form-group">
                            <label for="salary_min" class="block text-sm font-medium text-gray-700">Minimum Salary</label>
                            <input type="number" id="salary_min" name="salary_min" value="{{ old('salary_min') }}" min="0" step="0.01" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('salary_min') border-red-500 @enderror">
                            @error('salary_min')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <!-- Salary Max -->
                        <div class="form-group">
                            <label for="salary_max" class="block text-sm font-medium text-gray-700">Maximum Salary</label>
                            <input type="number" id="salary_max" name="salary_max" value="{{ old('salary_max') }}" min="0" step="0.01" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('salary_max') border-red-500 @enderror">
                            @error('salary_max')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <!-- Expires At -->
                    <div class="form-group">
                        <label for="expires_at" class="block text-sm font-medium text-gray-700">Expires At</label>
                        <input type="datetime-local" id="expires_at" name="expires_at" value="{{ old('expires_at') }}" class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary/30 form-input transition-all @error('expires_at') border-red-500 @enderror">
                        @error('expires_at')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('volunteer.jobs.listings') }}" class="px-6 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all btn-hover">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2 text-sm font-medium text-white bg-purple-500 border border-transparent rounded-lg shadow-sm hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all btn-hover">
                            Create Job Listing
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

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

            // Add smooth animations on page load
            const cards = document.querySelectorAll('.card-hover');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease-out';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</body>
</html>
