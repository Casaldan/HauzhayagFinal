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
        <x-sidebar role="volunteer" currentRoute="{{ request()->route()->getName() ?? 'dashboard' }}" />
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
                                <li><a href="{{ route('volunteer.dashboard') }}" class="hover:text-blue-200 transition-colors">Dashboard</a></li>
                                <li><svg class="w-4 h-4 mx-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></li>
                                <li class="text-blue-200">Volunteer Overview</li>
                            </ol>
                        </nav>

                        <!-- Header Content -->
                        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center space-y-4 lg:space-y-0">
                            <div class="flex items-center space-x-4">
                                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 515.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h1 class="text-3xl lg:text-4xl font-bold mb-2">Volunteer Dashboard</h1>
                                    <p class="text-blue-100 text-lg">Welcome back, {{ Auth::user()->name }}! Here's your volunteer overview.</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-3">
                                <span class="text-blue-100 font-medium">Volunteer</span>
                                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center text-white font-bold text-lg backdrop-blur-sm border border-white border-opacity-20">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="max-w-7xl mx-auto px-4 lg:px-8 -mt-16 relative z-10">

                    <!-- Enhanced Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <!-- Total Jobs -->
                        <div class="glass-card stat-card fade-in fade-in-delay-1 rounded-2xl p-6 hover-lift">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600 mb-1">Total Jobs</p>
                                    <p class="text-3xl font-bold text-purple-600">{{ $allJobs->count() }}</p>
                                    <p class="text-xs text-gray-500 mt-1">Job opportunities</p>
                                </div>
                                <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2M8 6v10a2 2 0 002 2h4a2 2 0 002-2V6"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Total Events -->
                        <div class="glass-card stat-card fade-in fade-in-delay-2 rounded-2xl p-6 hover-lift">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600 mb-1">Total Events</p>
                                    <p class="text-3xl font-bold gradient-text">{{ $events->count() }}</p>
                                    <p class="text-xs text-gray-500 mt-1">Available events</p>
                                </div>
                                <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center shadow-lg">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Enhanced Calendar and Events Section -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                        <!-- Calendar View -->
                        <div class="lg:col-span-2 glass-card rounded-2xl overflow-hidden shadow-xl">
                            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-800">Event Calendar</h3>
                                <p class="text-sm text-gray-600">Interactive calendar view of all events</p>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-6">
                                    <div class="flex items-center space-x-2">
                                        <button onclick="previousMonth()" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                            </svg>
                                        </button>
                                        <span id="currentMonth" class="text-sm font-medium text-gray-700 min-w-[120px] text-center"></span>
                                        <button onclick="nextMonth()" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Calendar Grid -->
                                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-4 border border-blue-200">
                                    <div class="grid grid-cols-7 gap-1 text-center text-sm">
                                        <!-- Day Headers -->
                                        <div class="font-semibold text-gray-600 p-3">Sun</div>
                                        <div class="font-semibold text-gray-600 p-3">Mon</div>
                                        <div class="font-semibold text-gray-600 p-3">Tue</div>
                                        <div class="font-semibold text-gray-600 p-3">Wed</div>
                                        <div class="font-semibold text-gray-600 p-3">Thu</div>
                                        <div class="font-semibold text-gray-600 p-3">Fri</div>
                                        <div class="font-semibold text-gray-600 p-3">Sat</div>

                                        <!-- Calendar Days -->
                                        <div id="calendarDays" class="contents">
                                            <!-- Days will be populated by JavaScript -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Enhanced Upcoming Events -->
                        <div class="glass-card rounded-2xl overflow-hidden shadow-xl">
                            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-800">Upcoming Events</h3>
                                <p class="text-sm text-gray-600">Next scheduled events</p>
                            </div>
                            <div class="p-6">
                                <div class="space-y-4" id="upcoming-events">
                                    @forelse($events as $event)
                                        <div class="event-card p-4 border border-gray-200 rounded-xl hover:bg-gray-50 cursor-pointer transition-all duration-300 hover:shadow-lg hover:scale-105" onclick="window.location.href='{{ route('volunteer.events') }}'">
                                            <div class="flex items-start space-x-3">
                                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center text-white shadow-lg">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                </div>
                                                <div class="flex-1">
                                                    <h4 class="font-semibold text-gray-900 mb-1">{{ $event->title }}</h4>
                                                    <div class="flex items-center text-sm text-gray-600 mb-1">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                        {{ \Carbon\Carbon::parse($event->start_date)->format('M j, Y') }}
                                                    </div>
                                                    <div class="flex items-center text-sm text-gray-500">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        </svg>
                                                        {{ $event->location }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="text-center py-8">
                                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                            <h3 class="text-lg font-semibold text-gray-900 mb-2">No upcoming events</h3>
                                            <p class="text-gray-600">Events will appear here when scheduled</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- Enhanced Job Listings Section -->
                    <div class="glass-card rounded-2xl overflow-hidden shadow-xl mb-8">
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">Job Listings</h3>
                                    <p class="text-sm text-gray-600">Browse and manage job opportunities</p>
                                </div>
                                <div class="flex space-x-3">
                                    <a href="{{ route('volunteer.jobs') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-xl transition-all duration-300 font-medium shadow-lg hover:shadow-xl hover:scale-105 flex items-center space-x-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2M8 6v10a2 2 0 002 2h4a2 2 0 002-2V6"/>
                                        </svg>
                                        <span>View Jobs</span>
                                    </a>
                                    <a href="{{ route('volunteer.jobs.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-xl transition-all duration-300 font-medium shadow-lg hover:shadow-xl hover:scale-105 flex items-center space-x-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                        <span>Post Job</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
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
                            <a href="{{ route('volunteer.jobs') }}" class="bg-purple-500 text-white px-6 py-2 rounded-lg hover:bg-purple-600 transition-all duration-300 hover-scale">
                                View Job Listings
                            </a>
                        </div>
                        @endforelse
                    </div>
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

        // Calendar functionality
        let currentDate = new Date();
        const events = @json($events->map(function($event) {
            return [
                'title' => $event->title,
                'date' => $event->start_date,
                'id' => $event->id
            ];
        }));

        function renderCalendar() {
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();

            // Update month display
            const monthNames = ["January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"];
            document.getElementById('currentMonth').textContent = `${monthNames[month]} ${year}`;

            // Get first day of month and number of days
            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();

            // Clear calendar
            const calendarDays = document.getElementById('calendarDays');
            calendarDays.innerHTML = '';

            // Add empty cells for days before month starts
            for (let i = 0; i < firstDay; i++) {
                const emptyDay = document.createElement('div');
                emptyDay.className = 'p-2';
                calendarDays.appendChild(emptyDay);
            }

            // Add days of month
            for (let day = 1; day <= daysInMonth; day++) {
                const dayElement = document.createElement('div');
                dayElement.className = 'p-2 hover:bg-white rounded cursor-pointer transition-colors';
                dayElement.textContent = day;

                // Check if this day has events
                const dayDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                const dayEvents = events.filter(event => event.date.startsWith(dayDate));

                if (dayEvents.length > 0) {
                    dayElement.className += ' bg-green-100 text-green-800 font-semibold';
                    dayElement.title = dayEvents.map(e => e.title).join(', ');
                }

                // Highlight today
                const today = new Date();
                if (year === today.getFullYear() && month === today.getMonth() && day === today.getDate()) {
                    dayElement.className += ' bg-blue-500 text-white font-bold';
                }

                calendarDays.appendChild(dayElement);
            }
        }

        function previousMonth() {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
        }

        function nextMonth() {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar();
        }

        // Initialize calendar
        document.addEventListener('DOMContentLoaded', function() {
            renderCalendar();
        });
    </script>
</body>
</html>
