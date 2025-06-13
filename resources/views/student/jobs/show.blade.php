<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Job Details - {{ config('app.name', 'Hauz Hayag') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('image/logohauzhayag.jpg') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('image/logohauzhayag.jpg') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('image/logohauzhayag.jpg') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('image/logohauzhayag.jpg') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('image/logohauzhayag.jpg') }}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('image/logohauzhayag.jpg') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('image/logohauzhayag.jpg') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('image/logohauzhayag.jpg') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('image/logohauzhayag.jpg') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('image/logohauzhayag.jpg') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('image/logohauzhayag.jpg') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('image/logohauzhayag.jpg') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('image/logohauzhayag.jpg') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('image/logohauzhayag.jpg') }}">
    <meta name="msapplication-TileImage" content="{{ asset('image/logohauzhayag.jpg') }}">
    <meta name="msapplication-TileColor" content="#3A5F6B">
    <meta name="theme-color" content="#3A5F6B">

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
        /* Enhanced hover effects */
        .hover-scale {
            transition: transform 0.3s ease-in-out;
        }
        .hover-scale:hover {
            transform: scale(1.02);
        }

        /* Card animations */
        .card-hover {
            transition: all 0.3s ease-in-out;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        /* Gradient backgrounds */
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .dashboard-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="bg-gray-100 font-['Inter']">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <x-sidebar role="student" currentRoute="{{ request()->route()->getName() ?? 'student.jobs.show' }}" />

        <!-- Main Content -->
        <div class="flex-1 lg:ml-64 overflow-y-auto">
            <!-- Mobile header spacer -->
            <div class="lg:hidden h-16"></div>
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
    <!-- Header -->
    <div class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold">Job Details</h1>
                    <p class="text-purple-100 mt-2">View complete job information</p>
                </div>
                <a href="{{ route('student.jobs.index') }}" class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-6 py-3 rounded-xl transition-all duration-300 font-medium backdrop-blur-sm border border-white border-opacity-20 hover:scale-105 flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span>Back to Jobs</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Job Details Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Job Header -->
            <div class="bg-gradient-to-r from-purple-50 to-indigo-50 px-8 py-6 border-b border-gray-200">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <h2 class="text-3xl font-bold text-gray-900 mb-3">{{ $job->title }}</h2>
                        <div class="space-y-2">
                            <p class="text-lg text-gray-700 flex items-center">
                                <svg class="w-5 h-5 mr-3 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                <strong>Company:</strong> <span class="ml-2">{{ $job->company_name ?? $job->company ?? 'Company not specified' }}</span>
                            </p>
                            <p class="text-lg text-gray-700 flex items-center">
                                <svg class="w-5 h-5 mr-3 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                                <strong>Location:</strong> <span class="ml-2">{{ $job->location ?? 'Location not specified' }}</span>
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-col items-end space-y-3">
                        <span class="px-4 py-2 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                            {{ ucfirst($job->status) }}
                        </span>
                        @if($job->is_admin_posted)
                            <span class="px-4 py-2 text-sm font-medium rounded-full bg-blue-100 text-blue-800">
                                Admin Posted
                            </span>
                        @else
                            <span class="px-4 py-2 text-sm font-medium rounded-full bg-orange-100 text-orange-800">
                                Volunteer Posted
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Job Tags -->
                <div class="flex flex-wrap gap-3 mt-6">
                    @if($job->employment_type)
                        <span class="px-4 py-2 text-sm font-medium rounded-full bg-blue-100 text-blue-800">
                            {{ $job->employment_type }}
                        </span>
                    @endif
                    @if($job->type)
                        <span class="px-4 py-2 text-sm font-medium rounded-full bg-green-100 text-green-800">
                            {{ $job->type }}
                        </span>
                    @endif
                    @if($job->category)
                        <span class="px-4 py-2 text-sm font-medium rounded-full bg-purple-100 text-purple-800">
                            {{ $job->category }}
                        </span>
                    @endif
                    @if($job->salary_min && $job->salary_max)
                        <span class="px-4 py-2 text-sm font-medium rounded-full bg-yellow-100 text-yellow-800">
                            ${{ number_format($job->salary_min) }} - ${{ number_format($job->salary_max) }}
                        </span>
                    @endif
                </div>
            </div>

            <!-- Job Content -->
            <div class="p-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Main Content -->
                    <div class="lg:col-span-2 space-y-8">
                        <!-- Job Description -->
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-6 h-6 mr-3 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m5-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                Job Description
                            </h3>
                            <div class="prose prose-lg text-gray-700">
                                <p>{{ $job->description }}</p>
                            </div>
                        </div>

                        <!-- Requirements -->
                        @if($job->requirements)
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-6 h-6 mr-3 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                </svg>
                                Requirements
                            </h3>
                            <div class="prose prose-lg text-gray-700">
                                <p>{{ $job->requirements }}</p>
                            </div>
                        </div>
                        @endif

                        <!-- Qualifications -->
                        @if($job->qualifications)
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-6 h-6 mr-3 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                                Qualifications
                            </h3>
                            <div class="prose prose-lg text-gray-700">
                                <p>{{ $job->qualifications }}</p>
                            </div>
                        </div>
                        @endif

                        <!-- Benefits -->
                        @if($job->benefits)
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-6 h-6 mr-3 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Benefits
                            </h3>
                            <div class="prose prose-lg text-gray-700">
                                <p>{{ $job->benefits }}</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-6">
                        <!-- Contact Information -->
                        <div class="bg-gradient-to-br from-purple-50 to-indigo-50 rounded-xl p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                Contact Information
                            </h3>
                            <div class="space-y-3">
                                @if($job->contact_person)
                                    <p class="text-sm text-gray-700 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        <strong>Contact:</strong> <span class="ml-1">{{ $job->contact_person }}</span>
                                    </p>
                                @endif
                                @if($job->contact_email)
                                    <p class="text-sm text-gray-700 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                        <strong>Email:</strong> <a href="mailto:{{ $job->contact_email }}" class="ml-1 text-purple-600 hover:underline">{{ $job->contact_email }}</a>
                                    </p>
                                @endif
                                @if($job->contact_phone)
                                    <p class="text-sm text-gray-700 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                        <strong>Phone:</strong> <a href="tel:{{ $job->contact_phone }}" class="ml-1 text-purple-600 hover:underline">{{ $job->contact_phone }}</a>
                                    </p>
                                @endif
                            </div>
                        </div>

                        <!-- Job Details -->
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Job Details
                            </h3>
                            <div class="space-y-3">
                                @if($job->start_date)
                                    <p class="text-sm text-gray-700">
                                        <strong>Start Date:</strong> {{ $job->start_date->format('F j, Y') }}
                                    </p>
                                @endif
                                @if($job->end_date)
                                    <p class="text-sm text-gray-700">
                                        <strong>End Date:</strong> {{ $job->end_date->format('F j, Y') }}
                                    </p>
                                @endif
                                @if($job->expiry_date || $job->expires_at)
                                    <p class="text-sm text-gray-700">
                                        <strong>Application Deadline:</strong> 
                                        {{ $job->expiry_date ? $job->expiry_date->format('F j, Y') : $job->expires_at->format('F j, Y') }}
                                    </p>
                                @endif
                                <p class="text-sm text-gray-700">
                                    <strong>Posted:</strong> {{ $job->created_at->format('F j, Y') }}
                                </p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        </div>
    </div>
</body>
</html>
