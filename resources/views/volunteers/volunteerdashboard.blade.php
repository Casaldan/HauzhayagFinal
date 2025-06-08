@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Dashboard</title>

    <!-- Add Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1B4B5A',
                        secondary: '#2C5F6E',
                        accent: '#00A4B8',
                    }
                }
            }
        }
    </script>
    <style>
        /* Custom styles for FullCalendar */
        .fc-event {
            background-color: #3490dc; /* Example event background color */
            border-color: #2779bd; /* Example event border color */
            color: #ffffff; /* Example event text color */
            border-radius: 4px; /* Example rounded corners for events */
            padding: 2px 4px; /* Example padding for events */
            font-size: 0.85em; /* Example font size for events */
            cursor: pointer; /* Indicate clickable events */
        }

        /* Optional: Style the calendar header */
        .fc-header-toolbar {
            margin-bottom: 1.5em; /* Space below header */
            font-size: 1.1em; /* Slightly larger header font */
        }

        /* Optional: Style calendar day cells with events */
        /* This might require more complex JS/CSS depending on FullCalendar version and setup */
        /* For simplicity, focusing on styling the event element itself first */

        /* General calendar container styling */
         .fc .fc-daygrid-day.fc-day-today {
            background-color: #e2e8f0; /* Highlight today's date with a light background */
         }

         .fc-daygrid-event {
             margin-top: 2px;
         }

        /* Enhance sidebar link hover effect */
        .sidebar-link:hover {
            background-color: #2C5F6E; /* Use secondary color for hover */
        }

        /* Style for active sidebar link if needed */
        .sidebar-link.active {
            background-color: #2C5F6E; /* Example active color */
            border-right: 4px solid #00A4B8; /* Example accent border */
        }

    </style>
</head>
<div class="flex h-screen overflow-hidden bg-gray-100">
    <!-- Sidebar Navigation -->
    <div class="w-64 bg-primary text-white flex flex-col fixed h-full overflow-y-auto shadow-lg top-0">
        <div class="p-4 flex items-center space-x-3 border-b border-secondary">
            <img src="{{ asset('image/logohauzhayag.jpg') }}" alt="Hauz Hayag Logo" class="h-16 w-auto rounded-lg shadow-md">
            <h1 class="text-2xl font-bold">Hauz Hayag</h1>
        </div>
        <nav class="flex-1 flex flex-col px-4 py-6 space-y-3">
            <a href="{{ route('volunteer.dashboard') }}" class="sidebar-link flex items-center py-2 px-3 rounded-md transition-colors hover:bg-secondary">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('volunteer.events') }}" class="sidebar-link flex items-center py-2 px-3 rounded-md transition-colors hover:bg-secondary">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Events
            </a>
            <a href="{{ route('volunteer.jobs.listings') }}" class="sidebar-link flex items-center py-2 px-3 rounded-md transition-colors hover:bg-secondary">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            Job Listings
        </a>
            <div class="mt-auto pt-6 px-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-3 py-2 hover:bg-secondary transition-colors text-red-300 hover:text-red-200 rounded-md text-left">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </nav>
    </div>
    <!-- Main Content -->
    <div class="flex-1 px-6 pb-6 pt-0 bg-gray-100 ml-64 overflow-y-auto h-screen rounded-tl-lg">
        <!-- Page Header -->
        <div class="mb-6 pb-4 border-b border-gray-200 mt-0">
            <h1 class="text-3xl font-bold text-gray-800">Volunteer Dashboard</h1>
            <p class="text-gray-600 mt-1">Welcome back, {{ Auth::user()->name }}! Here's an overview of your academic journey.</p>
        </div>
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <!-- Upcoming Events -->
            <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-blue-500">
                <div class="flex justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Upcoming Events</p>
                        <p class="text-xl font-bold text-gray-800 mt-1">{{ $events->count() }}</p>
                    </div>
                    <div class="rounded-full bg-blue-100 p-2">
                        <svg class="h-5 w-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <!-- Hours Volunteered -->
            <!-- <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-green-500">
                <div class="flex justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Hours This Month</p>
                        <p class="text-xl font-bold text-gray-800 mt-1">{{ $hoursThisMonth }}</p>
                    </div>
                    <div class="rounded-full bg-green-100 p-2">
                        <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div> -->
            <!-- Job Applications -->
            <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-purple-500">
                <div class="flex justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Approved Jobs</p>
                        <p class="text-xl font-bold text-gray-800 mt-1">{{ $allJobs->count() }}</p>
                    </div>
                    <div class="rounded-full bg-purple-100 p-2">
                        <svg class="h-5 w-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Calendar and Events Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <!-- Calendar View -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
                <div id="calendar"></div>
            </div>
            <!-- Upcoming Events -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-4">Upcoming Events</h3>
                <div class="space-y-4" id="upcoming-events">
                    @forelse($events as $event)
                    <div class="p-4 border rounded-lg hover:bg-gray-50 cursor-pointer" onclick="window.location.href='{{ route('volunteer.events') }}'">
                        <h4 class="font-semibold">{{ $event->title }}</h4>
                        <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($event->start_date)->format('F j, Y') }}</p>
                        <p class="text-sm text-gray-500">{{ Str::limit($event->description, 100) }}</p>
                    </div>
                    @empty
                    <div class="text-center text-gray-500 py-4">No upcoming events found.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-medium text-gray-900">Recent Activity</h2>
            </div>
            <div class="space-y-4">
                @forelse($recentActivities as $activity)
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-md font-medium text-gray-900">{{ $activity->event ? $activity->event->title : 'Volunteer Activity' }}</h3>
                            <p class="text-sm text-gray-600 mt-1">{{ $activity->hours }} hour(s) on {{ \Carbon\Carbon::parse($activity->date)->format('F d, Y') }}</p>
                        </div>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                    </div>
                </div>
                @empty
                <div class="text-center text-gray-500 py-4">No recent activity yet.</div>
                @endforelse
            </div>
        </div>

        <!-- Volunteer Applications Section -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <h2 class="text-lg font-medium text-gray-900 mb-4">My Event Applications</h2>

            <!-- Pending Applications -->
            <div class="mb-6">
                <h3 class="text-md font-medium text-gray-700 mb-3">Pending Applications</h3>
                <div class="space-y-3">
                    @forelse($pendingApplications as $application)
                        <div class="border border-yellow-200 rounded-lg p-4 bg-yellow-50">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900">{{ $application->event->title }}</h4>
                                    <p class="text-xs text-gray-600 mt-1">{{ $application->event->location }}</p>
                                    <p class="text-xs text-gray-500 mt-1">Applied: {{ $application->created_at->format('M d, Y') }}</p>
                                </div>
                                <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-800">Pending</span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-gray-500 py-4 text-sm">No pending applications</div>
                    @endforelse
                </div>
            </div>

            <!-- Approved Applications -->
            <div>
                <h3 class="text-md font-medium text-gray-700 mb-3">Approved Applications</h3>
                <div class="space-y-3">
                    @forelse($approvedApplications as $application)
                        <div class="border border-green-200 rounded-lg p-4 bg-green-50">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-900">{{ $application->event->title }}</h4>
                                    <p class="text-xs text-gray-600 mt-1">{{ $application->event->location }}</p>
                                    <p class="text-xs text-gray-500 mt-1">Event Date: {{ \Carbon\Carbon::parse($application->event->start_date)->format('M d, Y') }}</p>
                                </div>
                                <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-800">Approved</span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-gray-500 py-4 text-sm">No approved applications yet</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- My Job Listings Section -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-medium text-gray-900">Job Listings</h2>
                <div class="flex space-x-4">
                    <a href="{{ route('volunteer.jobs.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-400 transition">Add Job</a>
                </div>
            </div>
            <div class="space-y-4">
                @forelse($allJobs as $job)
                <div class="border border-gray-200 rounded-lg p-4 @if($job->posted_by == auth()->id()) bg-blue-50 @endif">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-md font-medium text-gray-900">{{ $job->title }}</h3>
                            <p class="text-sm text-gray-600 mt-1">{{ $job->company_name ?? $job->company }}</p>
                            <div class="mt-2 flex flex-wrap gap-2">
                                @if($job->employment_type)
                                    <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-800">
                                        {{ $job->employment_type }}
                                    </span>
                                @endif
                                @if($job->type)
                                    <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-800">
                                        {{ $job->type }}
                                    </span>
                                @endif
                                @if($job->salary)
                                    <span class="px-2 py-1 text-xs rounded bg-purple-100 text-purple-800">
                                        {{ $job->salary }}
                                    </span>
                                @endif
                                @if($job->posted_by == auth()->id())
                                    <span class="px-2 py-1 text-xs rounded
                                        @if($job->status == 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($job->status == 'approved') bg-green-100 text-green-800
                                        @elseif($job->status == 'rejected' || $job->status == 'declined') bg-red-100 text-red-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($job->status) }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <a href="{{ route('jobs.show', $job) }}" class="text-primary hover:underline text-sm">View Details</a>
                    </div>
                </div>
                @empty
                <div class="text-center text-gray-500 py-4">No jobs posted yet.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
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
            }
        });
        calendar.render();
    });
</script>
@endpush
