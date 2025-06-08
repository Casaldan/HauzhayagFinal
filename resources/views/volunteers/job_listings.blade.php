<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Job Listings - {{ config('app.name', 'Hauz Hayag') }}</title>
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
                            <svg class="w-7 h-7 mr-3 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2M8 6v10a2 2 0 002 2h4a2 2 0 002-2V6"/>
                            </svg>
                            Job Listings
                        </h2>
                        <p class="text-gray-600 mt-1">Discover and manage job opportunities</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('volunteer.jobs.create') }}" class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600 transition-all duration-300 hover-scale flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Add Job
                        </a>
                        <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </div>
                </div>

                <!-- Admin-Posted Jobs Section -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                    <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Admin-Posted Jobs
                    </h3>
                    <div class="grid gap-4">
                        @forelse($adminJobs as $job)
                        <div class="bg-white rounded-xl shadow-lg p-6 card-hover border-l-4 border-blue-500">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-start justify-between mb-4">
                                        <div>
                                            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $job->title }}</h3>
                                            <div class="space-y-2">
                                                <p class="text-sm text-gray-600 flex items-center">
                                                    <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                                    </svg>
                                                    {{ $job->company_name ?? $job->company ?? 'Company not specified' }}
                                                </p>
                                                @if($job->location)
                                                <p class="text-sm text-gray-600 flex items-center">
                                                    <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                    </svg>
                                                    {{ $job->location }}
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex flex-col items-end space-y-2">
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Admin Posted
                                            </span>
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ ucfirst($job->status) }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Job Tags -->
                                    <div class="flex flex-wrap gap-2 mb-4">
                                        @if($job->employment_type)
                                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                                {{ $job->employment_type }}
                                            </span>
                                        @endif
                                        @if($job->type)
                                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                                {{ $job->type }}
                                            </span>
                                        @endif
                                        @if($job->salary_min && $job->salary_max)
                                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800">
                                                ${{ number_format($job->salary_min) }} - ${{ number_format($job->salary_max) }}
                                            </span>
                                        @elseif($job->salary)
                                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800">
                                                {{ $job->salary }}
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Job Description -->
                                    <p class="text-gray-700 mb-4">{{ \Illuminate\Support\Str::limit($job->description, 200) }}</p>

                                    <!-- Action Button -->
                                    <div class="flex justify-end">
                                        <a href="{{ route('jobs.show', $job->id) }}" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-all duration-300 hover-scale flex items-center">
                                            <span>View Details</span>
                                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-500 mb-2">No admin jobs available</h3>
                            <p class="text-gray-400">Check back later for new opportunities!</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- My Submitted Jobs Section -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                    <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        My Submitted Jobs
                    </h3>
                    <div class="grid gap-4">
                        @forelse($myJobs as $job)
                        <div class="bg-gradient-to-r from-indigo-50 to-blue-50 rounded-xl shadow-lg p-6 card-hover border-l-4 border-indigo-500">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-start justify-between mb-4">
                                        <div>
                                            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $job->title }}</h3>
                                            <div class="space-y-2">
                                                <p class="text-sm text-gray-600 flex items-center">
                                                    <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                                    </svg>
                                                    {{ $job->company_name ?? $job->company ?? 'Company not specified' }}
                                                </p>
                                                @if($job->location)
                                                <p class="text-sm text-gray-600 flex items-center">
                                                    <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                    </svg>
                                                    {{ $job->location }}
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex flex-col items-end space-y-2">
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                                My Job
                                            </span>
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full
                                                @if($job->status == 'pending') bg-yellow-100 text-yellow-800
                                                @elseif($job->status == 'approved') bg-green-100 text-green-800
                                                @elseif($job->status == 'rejected' || $job->status == 'declined') bg-red-100 text-red-800
                                                @else bg-gray-100 text-gray-800 @endif">
                                                {{ ucfirst($job->status) }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Job Tags -->
                                    <div class="flex flex-wrap gap-2 mb-4">
                                        @if($job->employment_type)
                                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                                {{ $job->employment_type }}
                                            </span>
                                        @endif
                                        @if($job->type)
                                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                                {{ $job->type }}
                                            </span>
                                        @endif
                                        @if($job->salary_min && $job->salary_max)
                                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800">
                                                ${{ number_format($job->salary_min) }} - ${{ number_format($job->salary_max) }}
                                            </span>
                                        @elseif($job->salary)
                                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800">
                                                {{ $job->salary }}
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Job Description -->
                                    <p class="text-gray-700 mb-4">{{ \Illuminate\Support\Str::limit($job->description, 200) }}</p>

                                    <!-- Action Button -->
                                    <div class="flex justify-end">
                                        <a href="{{ route('jobs.show', $job->id) }}" class="bg-indigo-500 text-white px-6 py-2 rounded-lg hover:bg-indigo-600 transition-all duration-300 hover-scale flex items-center">
                                            <span>View Details</span>
                                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-500 mb-2">No submitted jobs yet</h3>
                            <p class="text-gray-400 mb-4">Start by creating your first job posting!</p>
                            <a href="{{ route('volunteer.jobs.create') }}" class="bg-purple-500 text-white px-6 py-2 rounded-lg hover:bg-purple-600 transition-all duration-300 hover-scale">
                                Create Job Listing
                            </a>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add smooth animations on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Animate cards on load
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

            // Add click animations
            const buttons = document.querySelectorAll('.hover-scale');
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 150);
                });
            });
        });
    </script>
</body>
</html>