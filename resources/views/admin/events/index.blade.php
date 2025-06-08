@extends('layouts.admin')

@push('styles')
<style>
    /* Enhanced hover effects for cards */
    .event-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    /* Smooth transitions for all interactive elements */
    .transition-all {
        transition: all 0.3s ease-in-out;
    }

    /* Enhanced button hover effects */
    .btn-hover:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* Calendar styling */
    .fc-event {
        background-color: #3B82F6 !important;
        border-color: #2563EB !important;
        color: #FFFFFF !important;
        border-radius: 6px !important;
        padding: 2px 6px !important;
        font-size: 0.875rem !important;
        font-weight: 500 !important;
    }

    .fc-event:hover {
        background-color: #2563EB !important;
        border-color: #1D4ED8 !important;
    }

    .fc-header-toolbar {
        margin-bottom: 1.5rem !important;
    }

    .fc .fc-daygrid-day.fc-day-today {
        background-color: #EFF6FF !important;
    }

    /* Enhanced table styling */
    .table-row:hover {
        background-color: #F8FAFC;
        transform: scale(1.01);
    }

    /* Status badge animations */
    .status-badge {
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
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
                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Event Management
        </h2>
        <div class="flex items-center space-x-3">
            <span class="text-gray-600">Admin</span>
            <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white font-medium">
                AD
            </div>
        </div>
    </div>

    <!-- Tab Navigation -->
    <div class="bg-white border-b border-gray-200 rounded-t-lg">
        <nav class="flex space-x-8 px-6" aria-label="Tabs">
            <button onclick="showTab('events')" id="events-tab" class="tab-button border-b-2 border-primary text-primary py-4 px-1 text-sm font-medium transition-colors duration-300 ease-in-out">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                All Events
            </button>
            <button onclick="showTab('calendar')" id="calendar-tab" class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 py-4 px-1 text-sm font-medium transition-colors duration-300 ease-in-out">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Calendar View
            </button>
        </nav>
    </div>

    <!-- Tab Content -->
    <div id="events-content" class="tab-content bg-white rounded-b-lg shadow">
        <div class="p-6">
            <!-- Page Header -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">All Events</h1>
                <p class="text-gray-600">Manage and organize events</p>
            </div>

            <!-- Stats Overview Section -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <!-- Total Events -->
                <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-blue-500 event-card transition-all">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Events</p>
                            <p class="text-xl font-bold text-gray-800 mt-1">{{ $totalEventsCount ?? $events->total() }}</p>
                        </div>
                        <div class="rounded-full bg-blue-100 p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Active Events -->
                <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-green-500 event-card transition-all">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Active Events</p>
                            <p class="text-xl font-bold text-gray-800 mt-1">{{ $activeEventsCount ?? 0 }}</p>
                        </div>
                        <div class="rounded-full bg-green-100 p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Events -->
                <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-yellow-500 event-card transition-all">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Upcoming Events</p>
                            <p class="text-xl font-bold text-gray-800 mt-1">{{ $upcomingEventsCount ?? 0 }}</p>
                        </div>
                        <div class="rounded-full bg-yellow-100 p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Completed Events -->
                <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-gray-500 event-card transition-all">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Completed Events</p>
                            <p class="text-xl font-bold text-gray-800 mt-1">{{ $completedEventsCount ?? 0 }}</p>
                        </div>
                        <div class="rounded-full bg-gray-100 p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Filter Tools -->
            <form id="event-search-form" method="GET" class="flex flex-wrap gap-3 mb-4">
                <div class="relative flex-grow max-w-md">
                    <input 
                        type="text" 
                        name="search" 
                        id="event-search-input"
                        placeholder="Search events..."
                        value="{{ request('search') }}"
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-secondary"
                    >
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                
                <!-- Status Filter -->
                <div class="relative">
                    <select name="status" class="appearance-none pl-3 pr-10 py-2 border border-gray-300 bg-white rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-secondary focus:border-secondary text-sm event-filter-dropdown">
                        <option value="">All Statuses</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                        </svg>
                    </div>
                </div>

                <a href="{{ route('events.create') }}" class="bg-secondary text-white px-4 py-2 rounded-lg hover:bg-secondary/80 transition-all btn-hover">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Event
                </a>
            </form>

            <!-- Events Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($events as $event)
                                <tr class="table-row transition-all duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center text-primary font-bold">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $event->title }}</div>
                                                <div class="text-sm text-gray-500">{{ Str::limit($event->description, 50) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <div class="font-medium">{{ $event->start_date->format('M d, Y') }}</div>
                                            <div class="text-gray-500">{{ $event->start_date->format('g:i A') }} - {{ $event->end_date->format('g:i A') }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $event->location ?? 'TBD' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="status-badge px-2 py-1 text-xs rounded-full
                                            @if($event->status == 'active') bg-green-100 text-green-800
                                            @elseif($event->status == 'completed') bg-blue-100 text-blue-800
                                            @elseif($event->status == 'cancelled') bg-red-100 text-red-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ ucfirst($event->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                        <a href="{{ route('events.show', $event) }}" class="bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700 transition-all btn-hover">
                                            View
                                        </a>
                                        <a href="{{ route('events.edit', $event) }}" class="bg-yellow-600 text-white px-3 py-1 rounded-lg hover:bg-yellow-700 transition-all btn-hover">
                                            Edit
                                        </a>
                                        <form action="{{ route('events.destroy', $event) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this event?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded-lg hover:bg-red-700 transition-all btn-hover">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="p-6">
                    {{ $events->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Calendar Tab Content -->
    <div id="calendar-content" class="tab-content hidden bg-white rounded-b-lg shadow">
        <div class="p-6">
            <!-- Page Header -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Calendar View</h1>
                <p class="text-gray-600">View events in calendar format</p>
            </div>

            <!-- Calendar and Events Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Calendar View -->
                <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
                    <div id="calendar"></div>
                </div>
                <!-- Upcoming Events -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold mb-4">Upcoming Events</h3>
                    <div class="space-y-4" id="upcoming-events">
                        @foreach($upcomingEvents ?? [] as $event)
                            <div class="event-card p-4 border rounded-lg hover:bg-gray-50 cursor-pointer transition-all duration-200" onclick="window.location.href='{{ route('events.show', $event) }}'">
                                <div class="flex items-start space-x-3">
                                    <div class="w-8 h-8 rounded-lg bg-primary/10 flex items-center justify-center text-primary">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-900">{{ $event->title }}</h4>
                                        <p class="text-sm text-gray-600">{{ $event->start_date->format('M d, Y g:i A') }}</p>
                                        <p class="text-sm text-gray-500">{{ $event->location ?? 'Location TBD' }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script>
    // Tab switching functionality
    function showTab(tabName) {
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });

        // Remove active class from all tabs
        document.querySelectorAll('.tab-button').forEach(tab => {
            tab.classList.remove('border-primary', 'text-primary');
            tab.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
        });

        // Show selected tab content
        document.getElementById(tabName + '-content').classList.remove('hidden');

        // Add active class to selected tab
        const activeTab = document.getElementById(tabName + '-tab');
        activeTab.classList.add('border-primary', 'text-primary');
        activeTab.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');

        // Initialize calendar if calendar tab is selected
        if (tabName === 'calendar') {
            initializeCalendar();
        }
    }

    // Initialize FullCalendar
    function initializeCalendar() {
        const calendarEl = document.getElementById('calendar');
        if (calendarEl && !calendarEl.hasChildNodes()) {
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: '{{ route("events.json") }}',
                eventClick: function(info) {
                    window.location.href = '/events/' + info.event.id;
                },
                height: 'auto',
                eventDisplay: 'block',
                eventBackgroundColor: '#3B82F6',
                eventBorderColor: '#2563EB',
                eventTextColor: '#FFFFFF'
            });
            calendar.render();
        }
    }

    // Search form functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Submit form on Enter in search
        const searchInput = document.getElementById('event-search-input');
        if (searchInput) {
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    document.getElementById('event-search-form').submit();
                }
            });
        }

        // Submit form on dropdown change
        document.querySelectorAll('.event-filter-dropdown').forEach(function(dropdown) {
            dropdown.addEventListener('change', function() {
                document.getElementById('event-search-form').submit();
            });
        });
    });
</script>
@endpush
