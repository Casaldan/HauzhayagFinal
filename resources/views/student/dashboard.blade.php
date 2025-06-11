<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Student Dashboard - {{ config('app.name', 'Hauz Hayag') }}</title>

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

        .gradient-bg-2 {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .gradient-bg-3 {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
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

        /* Professional Dashboard Styles */
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .stat-card {
            transition: all 0.3s ease-in-out;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .stat-card:hover::before {
            left: 100%;
        }

        .stat-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .fade-in {
            animation: fadeInUp 0.6s ease-out forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        .fade-in-delay-1 { animation-delay: 0.1s; }
        .fade-in-delay-2 { animation-delay: 0.2s; }
        .fade-in-delay-3 { animation-delay: 0.3s; }
        .fade-in-delay-4 { animation-delay: 0.4s; }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hover-lift {
            transition: all 0.3s ease-in-out;
        }

        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .dashboard-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="bg-gray-100 font-['Inter']">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <x-sidebar role="student" currentRoute="{{ request()->route()->getName() ?? 'dashboard' }}" />

        <!-- Main Content -->
        <div class="flex-1 lg:ml-64 overflow-y-auto">
            <!-- Mobile header spacer -->
            <div class="lg:hidden h-16"></div>

            <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
                <!-- Enhanced Header -->
                <div class="dashboard-gradient text-white p-6 lg:p-8 mb-8">
                    <div class="max-w-7xl mx-auto">
                        <!-- Breadcrumb -->
                        <nav class="text-sm mb-4 opacity-90">
                            <ol class="flex items-center space-x-2">
                                <li><a href="{{ route('student.dashboard') }}" class="hover:text-blue-200 transition-colors">Dashboard</a></li>
                                <li><svg class="w-4 h-4 mx-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></li>
                                <li class="text-blue-200">Student Overview</li>
                            </ol>
                        </nav>

                        <!-- Header Content -->
                        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center space-y-4 lg:space-y-0">
                            <div class="flex items-center space-x-4">
                                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                </div>
                                <div>
                                    <h1 class="text-3xl lg:text-4xl font-bold mb-2">Student Dashboard</h1>
                                    <p class="text-blue-100 text-lg">Welcome back, {{ Auth::user()->name }}! Here's your academic overview.</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-3">
                                <span class="text-blue-100 font-medium">Student</span>
                                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center text-white font-bold text-lg backdrop-blur-sm border border-white border-opacity-20">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="max-w-7xl mx-auto px-4 lg:px-8 -mt-16 relative z-10">

                <!-- Notifications -->
                @if(isset($notifications) && $notifications->count() > 0)
                <div class="bg-white rounded-xl shadow-sm p-6 mb-8 border border-blue-100">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM11 17H6l5 5v-5zM7 7h10l-5-5L7 7z"/>
                            </svg>
                            Notifications
                        </h2>
                        <form method="POST" action="{{ route('notifications.markAllAsRead') }}">
                            @csrf
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-all duration-300 hover-scale">
                                Mark all as read
                            </button>
                        </form>
                    </div>
                    <div class="space-y-4">
                        @foreach($notifications as $notification)
                        <div class="border border-gray-200 rounded-xl p-4 card-hover bg-gradient-to-r from-blue-50 to-indigo-50">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $notification->data['title'] }}</h3>
                                    <p class="text-sm text-gray-600 mt-1 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ \Carbon\Carbon::parse($notification->data['start_date'])->format('F j, Y g:i A') }}
                                    </p>
                                    <p class="text-sm text-gray-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        </svg>
                                        {{ $notification->data['location'] }}
                                    </p>
                                </div>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    New Event
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Stats Overview -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6 mb-6 lg:mb-8">
                    <!-- Upcoming Events -->
                    <div class="bg-white rounded-xl shadow-lg p-4 lg:p-6 card-hover border-l-4 border-green-500">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-xs lg:text-sm font-semibold text-gray-500 uppercase tracking-wide">Upcoming Events</p>
                                <p class="text-2xl lg:text-3xl font-bold text-gray-800 mt-2">{{ isset($eventCount) ? $eventCount : 0 }}</p>
                                <p class="text-xs lg:text-sm text-green-600 mt-1">Available to join</p>
                            </div>
                            <div class="rounded-full bg-green-100 p-3 lg:p-4">
                                <svg class="h-6 w-6 lg:h-8 lg:w-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Available Jobs -->
                    <div class="bg-white rounded-xl shadow-lg p-4 lg:p-6 card-hover border-l-4 border-purple-500">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-xs lg:text-sm font-semibold text-gray-500 uppercase tracking-wide">Available Jobs</p>
                                <p class="text-2xl lg:text-3xl font-bold text-gray-800 mt-2">{{ isset($jobCount) ? $jobCount : 0 }}</p>
                                <p class="text-xs lg:text-sm text-purple-600 mt-1">Open positions</p>
                            </div>
                            <div class="rounded-full bg-purple-100 p-3 lg:p-4">
                                <svg class="h-6 w-6 lg:h-8 lg:w-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    <!-- Quick Event Overview -->
                    <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Quick Overview
                        </h3>
                        <div class="space-y-4">
                            @if(isset($upcomingEvents) && $upcomingEvents->count() > 0)
                                @foreach($upcomingEvents->take(3) as $event)
                                <div class="p-3 border border-gray-200 rounded-lg hover:bg-green-50 cursor-pointer transition-all duration-300" onclick="window.location.href='{{ route('student.events.index') }}'">
                                    <h4 class="font-semibold text-gray-900 text-sm mb-1">{{ $event->title }}</h4>
                                    <p class="text-xs text-gray-600 flex items-center mb-1">
                                        <svg class="w-3 h-3 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ \Carbon\Carbon::parse($event->start_date)->format('M j, Y') }}
                                    </p>
                                    <p class="text-xs text-gray-500 flex items-center">
                                        <svg class="w-3 h-3 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        </svg>
                                        {{ $event->location }}
                                    </p>
                                </div>
                                @endforeach
                            @else
                                <div class="text-center py-6">
                                    <svg class="w-10 h-10 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <h3 class="text-sm font-medium text-gray-500 mb-1">No upcoming events</h3>
                                    <p class="text-xs text-gray-400">Check back later!</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            <!-- Latest Events Preview -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Latest Events
                    </h2>
                    <a href="{{ route('student.events.index') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-all duration-300 hover-scale flex items-center">
                        <span>View All Events</span>
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
                <div class="grid gap-4">
                    @forelse(($upcomingEvents ?? []) as $event)
                    <div class="border border-gray-200 rounded-xl p-6 card-hover bg-gradient-to-r from-green-50 to-emerald-50">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $event->title }}</h3>
                                <div class="space-y-2">
                                    <p class="text-sm text-gray-600 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ \Carbon\Carbon::parse($event->start_date)->format('M j, Y g:i A') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('M j, Y g:i A') }}
                                    </p>
                                    <p class="text-sm text-gray-600 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        </svg>
                                        {{ $event->location }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex flex-col items-end space-y-2">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ ucfirst($event->status) }}
                                </span>
                                <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-all duration-300 text-sm font-medium hover-scale">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-500 mb-2">No upcoming events</h3>
                        <p class="text-gray-400">Check back later for new events!</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Latest Job Listings -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2M8 6v10a2 2 0 002 2h4a2 2 0 002-2V6"/>
                        </svg>
                        Latest Job Listings
                    </h2>
                    <a href="{{ route('student.jobs.index') }}" class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600 transition-all duration-300 hover-scale flex items-center">
                        <span>View All Jobs</span>
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
                <div class="grid gap-4">
                    @forelse(($latestJobs ?? []) as $job)
                    <div class="border border-gray-200 rounded-xl p-6 card-hover bg-gradient-to-r from-purple-50 to-indigo-50">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $job->title }}</h3>
                                <div class="space-y-2 mb-3">
                                    <p class="text-sm text-gray-600 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                        {{ $job->company_name ?? $job->company }}
                                    </p>
                                    <p class="text-sm text-gray-600 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        </svg>
                                        {{ $job->location }}
                                    </p>
                                </div>
                                <div class="flex flex-wrap gap-2 mb-3">
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
                                    @endif
                                </div>
                                <p class="text-sm text-gray-600">{{ \Illuminate\Support\Str::limit($job->description, 120) }}</p>
                            </div>
                            <div class="flex flex-col items-end space-y-2 ml-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ ucfirst($job->status) }}
                                </span>
                                <a href="{{ route('jobs.show', $job->id) }}" class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600 transition-all duration-300 text-sm font-medium hover-scale">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2M8 6v10a2 2 0 002 2h4a2 2 0 002-2V6"/>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-500 mb-2">No job listings available</h3>
                        <p class="text-gray-400">Check back later for new opportunities!</p>
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
            if (calendarEl) {
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    events: '{{ route("events.json") }}',
                    eventClick: function(info) {
                        window.location.href = '{{ route("student.events.index") }}';
                    },
                    height: 'auto',
                    eventDisplay: 'block',
                    dayMaxEvents: 3
                });
                calendar.render();
            }

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