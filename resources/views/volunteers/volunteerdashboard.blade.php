<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Volunteer Dashboard - {{ config('app.name', 'Hauz Hayag') }}</title>
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

        /* Calendar styling */
        .fc-event {
            background-color: #3490dc;
            border-color: #2779bd;
            color: #ffffff;
            border-radius: 4px;
            padding: 2px 4px;
            font-size: 0.85em;
            cursor: pointer;
        }

        .fc-header-toolbar {
            margin-bottom: 1.5em;
            font-size: 1.1em;
        }

        .fc .fc-daygrid-day.fc-day-today {
            background-color: #e2e8f0;
        }

        .fc-daygrid-event {
            margin-top: 2px;
        }
    </style>
</head>
<body class="bg-gray-100 font-['Inter']">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <x-sidebar role="volunteer" currentRoute="{{ request()->route()->getName() ?? 'dashboard' }}" />
        <!-- Main Content -->
        <div class="flex-1 ml-64 overflow-y-auto">
            <div class="p-8">
                <!-- Header -->
                <div class="bg-white p-6 flex justify-between items-center shadow-sm rounded-lg mb-8">
                    <div>
                        <h2 class="text-2xl font-bold flex items-center text-gray-800">
                            <svg class="w-7 h-7 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 515.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            Volunteer Dashboard
                        </h2>
                        <p class="text-gray-600 mt-1">Welcome back, {{ Auth::user()->name }}! Here's your volunteer overview.</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="text-gray-600 font-medium">Volunteer</span>
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </div>
                </div>

                <!-- Stats Overview -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Upcoming Events -->
                    <div class="bg-white rounded-xl shadow-lg p-6 card-hover border-l-4 border-green-500">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Upcoming Events</p>
                                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $events->count() }}</p>
                                <p class="text-sm text-green-600 mt-1">Available to join</p>
                            </div>
                            <div class="rounded-full bg-green-100 p-4">
                                <svg class="h-8 w-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Volunteer Hours -->
                    <div class="bg-white rounded-xl shadow-lg p-6 card-hover border-l-4 border-blue-500">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Hours This Month</p>
                                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $hoursThisMonth ?? 0 }}</p>
                                <p class="text-sm text-blue-600 mt-1">Volunteer hours</p>
                            </div>
                            <div class="rounded-full bg-blue-100 p-4">
                                <svg class="h-8 w-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Job Listings -->
                    <div class="bg-white rounded-xl shadow-lg p-6 card-hover border-l-4 border-purple-500">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Available Jobs</p>
                                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $allJobs->count() }}</p>
                                <p class="text-sm text-purple-600 mt-1">Job opportunities</p>
                            </div>
                            <div class="rounded-full bg-purple-100 p-4">
                                <svg class="h-8 w-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2M8 6v10a2 2 0 002 2h4a2 2 0 002-2V6"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Calendar and Events Section -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                    <!-- Calendar View -->
                    <div class="lg:col-span-2 bg-white rounded-xl shadow-lg p-6 card-hover">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Event Calendar
                        </h3>
                        <div id="calendar"></div>
                    </div>
                    <!-- Upcoming Events -->
                    <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Upcoming Events
                        </h3>
                        <div class="space-y-4" id="upcoming-events">
                            @forelse($events as $event)
                            <div class="p-4 border border-gray-200 rounded-xl hover:bg-green-50 cursor-pointer transition-all duration-300 card-hover" onclick="window.location.href='{{ route('volunteer.events') }}'">
                                <h4 class="font-semibold text-gray-900 mb-2">{{ $event->title }}</h4>
                                <p class="text-sm text-gray-600 flex items-center mb-1">
                                    <svg class="w-4 h-4 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ \Carbon\Carbon::parse($event->start_date)->format('M j, Y') }}
                                </p>
                                <p class="text-sm text-gray-600 flex items-center mb-2">
                                    <svg class="w-4 h-4 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    </svg>
                                    {{ $event->location }}
                                </p>
                                <p class="text-sm text-gray-500">{{ Str::limit($event->description, 80) }}</p>
                            </div>
                            @empty
                            <div class="text-center py-8">
                                <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <h3 class="text-sm font-medium text-gray-500 mb-1">No upcoming events</h3>
                                <p class="text-xs text-gray-400">Check back later for new events!</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Volunteer Applications Section -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        My Event Applications
                    </h2>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Pending Applications -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-700 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Pending Applications
                            </h3>
                            <div class="space-y-3">
                                @forelse($pendingApplications as $application)
                                    <div class="border border-yellow-200 rounded-xl p-4 bg-gradient-to-r from-yellow-50 to-orange-50 card-hover">
                                        <div class="flex justify-between items-start">
                                            <div class="flex-1">
                                                <h4 class="font-semibold text-gray-900 mb-2">{{ $application->event->title }}</h4>
                                                <p class="text-sm text-gray-600 flex items-center mb-1">
                                                    <svg class="w-4 h-4 mr-1 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                    </svg>
                                                    {{ $application->event->location }}
                                                </p>
                                                <p class="text-xs text-gray-500">Applied: {{ $application->created_at->format('M d, Y') }}</p>
                                            </div>
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-8">
                                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <h3 class="text-sm font-medium text-gray-500 mb-1">No pending applications</h3>
                                        <p class="text-xs text-gray-400">Your applications will appear here</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Approved Applications -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-700 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Approved Applications
                            </h3>
                            <div class="space-y-3">
                                @forelse($approvedApplications as $application)
                                    <div class="border border-green-200 rounded-xl p-4 bg-gradient-to-r from-green-50 to-emerald-50 card-hover">
                                        <div class="flex justify-between items-start">
                                            <div class="flex-1">
                                                <h4 class="font-semibold text-gray-900 mb-2">{{ $application->event->title }}</h4>
                                                <p class="text-sm text-gray-600 flex items-center mb-1">
                                                    <svg class="w-4 h-4 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                    </svg>
                                                    {{ $application->event->location }}
                                                </p>
                                                <p class="text-xs text-gray-500">Event: {{ \Carbon\Carbon::parse($application->event->start_date)->format('M d, Y') }}</p>
                                            </div>
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Approved</span>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-8">
                                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        <h3 class="text-sm font-medium text-gray-500 mb-1">No approved applications yet</h3>
                                        <p class="text-xs text-gray-400">Approved events will appear here</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Job Listings Section -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2M8 6v10a2 2 0 002 2h4a2 2 0 002-2V6"/>
                            </svg>
                            Job Listings
                        </h2>
                        <a href="{{ route('volunteer.jobs.create') }}" class="bg-purple-500 text-white px-6 py-2 rounded-lg hover:bg-purple-600 transition-all duration-300 hover-scale flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Add Job
                        </a>
                    </div>
                    <div class="grid gap-4">
                        @forelse($allJobs as $job)
                        <div class="border border-gray-200 rounded-xl p-6 card-hover @if($job->posted_by == auth()->id()) bg-gradient-to-r from-blue-50 to-indigo-50 border-blue-200 @else bg-gradient-to-r from-purple-50 to-pink-50 @endif">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $job->title }}</h3>
                                    <p class="text-sm text-gray-600 flex items-center mb-3">
                                        <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                        {{ $job->company_name ?? $job->company }}
                                    </p>
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
                                        @if($job->salary)
                                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800">
                                                {{ $job->salary }}
                                            </span>
                                        @endif
                                        @if($job->posted_by == auth()->id())
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full
                                                @if($job->status == 'pending') bg-yellow-100 text-yellow-800
                                                @elseif($job->status == 'approved') bg-green-100 text-green-800
                                                @elseif($job->status == 'rejected' || $job->status == 'declined') bg-red-100 text-red-800
                                                @else bg-gray-100 text-gray-800 @endif">
                                                {{ ucfirst($job->status) }}
                                            </span>
                                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-indigo-100 text-indigo-800">
                                                My Job
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <a href="{{ route('jobs.show', $job) }}" class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600 transition-all duration-300 hover-scale text-sm font-medium">
                                    View Details
                                </a>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2M8 6v10a2 2 0 002 2h4a2 2 0 002-2V6"/>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-500 mb-2">No job listings yet</h3>
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

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize calendar
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: '{{ route("events.json") }}',
                eventClick: function(info) {
                    window.location.href = '{{ route("volunteer.events") }}';
                },
                height: 'auto',
                eventDisplay: 'block',
                dayMaxEvents: 3
            });
            calendar.render();

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
