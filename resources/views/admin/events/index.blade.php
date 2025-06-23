@extends('layouts.admin')

@push('styles')
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
        background: rgba(27, 75, 90, 0.1);
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

    .primary-text {
        color: #007cba;
    }

    .dashboard-primary {
        background: #007cba;
    }

    /* Enhanced FullCalendar Styles */
    #calendar {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    /* Calendar container styling */
    .fc {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    /* Calendar day cells */
    .fc-daygrid-day {
        border: 1px solid #f1f5f9 !important;
        transition: all 0.2s ease-in-out;
    }

    .fc-daygrid-day:hover {
        background-color: rgba(102, 126, 234, 0.05) !important;
    }

    .fc-day-today {
        background-color: rgba(102, 126, 234, 0.1) !important;
        border-color: #667eea !important;
    }

    /* Calendar day numbers */
    .fc-daygrid-day-number {
        padding: 8px !important;
        font-weight: 600 !important;
        color: #374151 !important;
        transition: all 0.2s ease-in-out;
    }

    .fc-day-today .fc-daygrid-day-number {
        color: #667eea !important;
        font-weight: 700 !important;
    }

    /* Calendar events */
    .fc-event {
        border: none !important;
        border-radius: 8px !important;
        padding: 4px 8px !important;
        margin: 2px !important;
        font-size: 12px !important;
        font-weight: 600 !important;
        cursor: pointer !important;
        transition: all 0.2s ease-in-out !important;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
    }

    .fc-event:hover {
        transform: scale(1.05) !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
        z-index: 1000 !important;
    }

    /* Calendar buttons */
    .fc-button {
        border: none !important;
        border-radius: 8px !important;
        padding: 8px 16px !important;
        font-weight: 600 !important;
        transition: all 0.2s ease-in-out !important;
        background: #007cba !important;
        color: white !important;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1) !important;
        margin: 0 2px !important;
    }

    .fc-button:hover {
        transform: translateY(-1px) !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
    }

    .fc-button:disabled {
        opacity: 0.6 !important;
        transform: none !important;
    }

    .fc-button-active {
        background: #005a8a !important;
        box-shadow: 0 4px 12px rgba(0, 124, 186, 0.3) !important;
    }

    /* Calendar title */
    .fc-toolbar-title {
        font-size: 24px !important;
        font-weight: 700 !important;
        color: #007cba !important;
    }

    /* More link styling */
    .fc-more-link {
        color: #667eea !important;
        font-weight: 600 !important;
        text-decoration: none !important;
        padding: 2px 6px !important;
        border-radius: 4px !important;
        transition: all 0.2s ease-in-out !important;
    }

    .fc-more-link:hover {
        background-color: rgba(102, 126, 234, 0.1) !important;
        transform: scale(1.05) !important;
    }

    /* Popover styling */
    .fc-popover {
        border: none !important;
        border-radius: 12px !important;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
        backdrop-filter: blur(20px) !important;
        background: rgba(255, 255, 255, 0.95) !important;
    }

    .fc-popover-header {
        background: #f8fafc !important;
        border-bottom: 1px solid #e2e8f0 !important;
        padding: 12px 16px !important;
        font-weight: 600 !important;
    }

    /* Week/Day view styling */
    .fc-timegrid-slot {
        border-color: #f1f5f9 !important;
    }

    .fc-timegrid-axis {
        border-color: #f1f5f9 !important;
    }

    /* List view styling */
    .fc-list-event {
        border-left: 4px solid #667eea !important;
        transition: all 0.2s ease-in-out !important;
    }

    .fc-list-event:hover {
        background-color: rgba(102, 126, 234, 0.05) !important;
        transform: translateX(4px) !important;
    }

    /* Responsive calendar adjustments */
    @media (max-width: 768px) {
        .fc-toolbar {
            flex-direction: column !important;
            gap: 10px !important;
        }

        .fc-toolbar-chunk {
            display: flex !important;
            justify-content: center !important;
        }

        .fc-button {
            padding: 6px 12px !important;
            font-size: 12px !important;
        }

        .fc-toolbar-title {
            font-size: 18px !important;
            margin: 10px 0 !important;
        }
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Enhanced Header -->
    <div class="dashboard-primary text-white p-6 lg:p-8 mb-8">
        <div class="max-w-7xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="text-sm mb-4 opacity-90">
                <ol class="flex items-center space-x-2">
                    <li><a href="{{ route('admin.dashboard') }}" class="hover:text-blue-200 transition-colors">Dashboard</a></li>
                    <li><svg class="w-4 h-4 mx-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></li>
                    <li class="text-blue-200">Event Management</li>
                </ol>
            </nav>

            <!-- Header Content -->
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center space-y-4 lg:space-y-0">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl lg:text-4xl font-bold mb-2">Event Management</h1>
                        <p class="text-blue-100 text-lg">Manage and organize events</p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3">
                    <!-- CSV Import Button -->
                    <button onclick="openImportModal()" class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-6 py-3 rounded-xl transition-all duration-300 font-medium backdrop-blur-sm border border-white border-opacity-20 hover:scale-105 flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                        </svg>
                        <span>Import CSV</span>
                    </button>

                    <!-- Add Event Button -->
                    <a href="{{ route('events.create') }}" class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-6 py-3 rounded-xl transition-all duration-300 font-medium backdrop-blur-sm border border-white border-opacity-20 hover:scale-105 flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span>Add Event</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 lg:px-8 -mt-16 relative z-10">

        <!-- Enhanced Tab Navigation -->
        <div class="glass-card rounded-2xl mb-8 overflow-hidden">
            <nav class="flex bg-gray-50" aria-label="Tabs">
                <button onclick="showTab('events')" id="events-tab" class="tab-button flex-1 border-b-4 border-blue-500 text-blue-600 py-4 px-6 text-sm font-semibold transition-all duration-300 ease-in-out flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>All Events</span>
                </button>
                <button onclick="showTab('calendar')" id="calendar-tab" class="tab-button flex-1 border-b-4 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 py-4 px-6 text-sm font-semibold transition-all duration-300 ease-in-out flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <span>Calendar View</span>
                </button>
            </nav>
        </div>

        <!-- Tab Content -->
        <div id="events-content" class="tab-content">
            <!-- Enhanced Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Events -->
                <div class="glass-card stat-card fade-in fade-in-delay-1 rounded-2xl p-6 hover-lift">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Total Events</p>
                            <p class="text-3xl font-bold primary-text">{{ $totalEventsCount ?? $events->total() }}</p>
                            <p class="text-xs text-gray-500 mt-1">All events</p>
                        </div>
                        <div class="w-14 h-14 bg-primary rounded-2xl flex items-center justify-center shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Active Events
                <div class="glass-card stat-card fade-in fade-in-delay-2 rounded-2xl p-6 hover-lift">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Active Events</p>
                            <p class="text-3xl font-bold text-green-600">{{ $activeEventsCount ?? 0 }}</p>
                            <p class="text-xs text-gray-500 mt-1">Currently active</p>
                        </div>
                        <div class="w-14 h-14 bg-green-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div> -->

                <!-- Upcoming Events -->
                <div class="glass-card stat-card fade-in fade-in-delay-3 rounded-2xl p-6 hover-lift">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Upcoming Events</p>
                            <p class="text-3xl font-bold text-yellow-600">{{ $upcomingEventsCount ?? 0 }}</p>
                            <p class="text-xs text-gray-500 mt-1">Coming soon</p>
                        </div>
                        <div class="w-14 h-14 bg-yellow-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Completed Events -->
                <div class="glass-card stat-card fade-in fade-in-delay-4 rounded-2xl p-6 hover-lift">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Completed Events</p>
                            <p class="text-3xl font-bold text-gray-600">{{ $completedEventsCount ?? 0 }}</p>
                            <p class="text-xs text-gray-500 mt-1">Finished events</p>
                        </div>
                        <div class="w-14 h-14 bg-gray-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
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

        <!-- Enhanced Calendar Tab Content -->
        <div id="calendar-content" class="tab-content hidden">
            <!-- Enhanced Calendar and Events Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Calendar View -->
                <div class="lg:col-span-2 glass-card rounded-2xl overflow-hidden shadow-xl">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800">Event Calendar</h3>
                        <p class="text-sm text-gray-600">Interactive calendar view of all events</p>
                    </div>
                    <div class="p-6">
                        <div id="calendar" class="rounded-xl overflow-hidden"></div>
                    </div>
                </div>

                <!-- Enhanced Upcoming Events -->
                <div class="glass-card rounded-2xl overflow-hidden shadow-xl">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800">Upcoming Events</h3>
                        <p class="text-sm text-gray-600">Next scheduled events</p>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4" id="upcoming-events">
                            @forelse($upcomingEvents ?? [] as $event)
                                <div class="event-card p-4 border border-gray-200 rounded-xl hover:bg-gray-50 cursor-pointer transition-all duration-300 hover:shadow-lg hover:scale-105" onclick="window.location.href='{{ route('events.show', $event) }}'">
                                    <div class="flex items-start space-x-3">
                                        <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center text-white shadow-lg">
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
                                                {{ $event->start_date->format('M d, Y g:i A') }}
                                            </div>
                                            <div class="flex items-center text-sm text-gray-500">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                {{ $event->location ?? 'Location TBD' }}
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

    // Initialize Enhanced FullCalendar
    function initializeCalendar() {
        const calendarEl = document.getElementById('calendar');
        if (calendarEl && !calendarEl.hasChildNodes()) {
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                buttonText: {
                    today: 'Today',
                    month: 'Month',
                    week: 'Week',
                    day: 'Day',
                    list: 'List'
                },
                events: '{{ route("events.json") }}',
                eventClick: function(info) {
                    // Enhanced event click with animation
                    info.el.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        info.el.style.transform = 'scale(1)';
                        window.location.href = '/admin/events/' + info.event.id;
                    }, 150);
                },
                eventMouseEnter: function(info) {
                    // Add hover effect
                    info.el.style.transform = 'scale(1.05)';
                    info.el.style.zIndex = '1000';
                    info.el.style.boxShadow = '0 8px 25px rgba(0,0,0,0.15)';
                    info.el.style.transition = 'all 0.2s ease-in-out';
                },
                eventMouseLeave: function(info) {
                    // Remove hover effect
                    info.el.style.transform = 'scale(1)';
                    info.el.style.zIndex = 'auto';
                    info.el.style.boxShadow = 'none';
                },
                height: 'auto',
                aspectRatio: 1.8,
                eventDisplay: 'block',
                eventBackgroundColor: '#667eea',
                eventBorderColor: '#5a67d8',
                eventTextColor: '#ffffff',
                dayMaxEvents: 3,
                moreLinkClick: 'popover',
                navLinks: true,
                selectable: true,
                selectMirror: true,
                select: function(info) {
                    // Allow creating events by selecting dates
                    if (confirm('Create a new event on ' + info.startStr + '?')) {
                        window.location.href = '/admin/events/create?date=' + info.startStr;
                    }
                    calendar.unselect();
                },
                eventDidMount: function(info) {
                    // Add custom styling to events
                    info.el.style.borderRadius = '8px';
                    info.el.style.border = 'none';
                    info.el.style.padding = '4px 8px';
                    info.el.style.fontSize = '12px';
                    info.el.style.fontWeight = '600';
                    info.el.style.cursor = 'pointer';

                    // Add solid background based on event type
                    const eventType = info.event.extendedProps.type || 'default';
                    switch(eventType) {
                        case 'workshop':
                            info.el.style.background = '#007cba';
                            break;
                        case 'seminar':
                            info.el.style.background = '#005a8a';
                            break;
                        case 'conference':
                            info.el.style.background = '#007cba';
                            break;
                        default:
                            info.el.style.background = '#007cba';
                    }
                },
                dayCellDidMount: function(info) {
                    // Style day cells
                    if (info.isToday) {
                        info.el.style.backgroundColor = 'rgba(102, 126, 234, 0.1)';
                        info.el.style.fontWeight = 'bold';
                    }
                },
                viewDidMount: function(info) {
                    // Add custom styling to calendar header
                    const toolbar = calendarEl.querySelector('.fc-toolbar');
                    if (toolbar) {
                        toolbar.style.marginBottom = '20px';
                        toolbar.style.padding = '15px';
                        toolbar.style.background = '#f8fafc';
                        toolbar.style.borderRadius = '12px';
                        toolbar.style.border = '1px solid #e2e8f0';
                    }

                    // Style calendar buttons
                    const buttons = calendarEl.querySelectorAll('.fc-button');
                    buttons.forEach(button => {
                        button.style.borderRadius = '8px';
                        button.style.border = 'none';
                        button.style.padding = '8px 16px';
                        button.style.fontWeight = '600';
                        button.style.transition = 'all 0.2s ease-in-out';
                        button.style.background = '#007cba';
                        button.style.color = 'white';
                        button.style.boxShadow = '0 2px 4px rgba(0,0,0,0.1)';

                        button.addEventListener('mouseenter', function() {
                            this.style.transform = 'translateY(-1px)';
                            this.style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';
                        });

                        button.addEventListener('mouseleave', function() {
                            this.style.transform = 'translateY(0)';
                            this.style.boxShadow = '0 2px 4px rgba(0,0,0,0.1)';
                        });
                    });

                    // Style the title
                    const title = calendarEl.querySelector('.fc-toolbar-title');
                    if (title) {
                        title.style.fontSize = '24px';
                        title.style.fontWeight = 'bold';
                        title.style.background = 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)';
                        title.style.webkitBackgroundClip = 'text';
                        title.style.webkitTextFillColor = 'transparent';
                        title.style.backgroundClip = 'text';
                    }
                }
            });
            calendar.render();

            // Add loading animation
            calendarEl.style.opacity = '0';
            calendarEl.style.transform = 'translateY(20px)';
            setTimeout(() => {
                calendarEl.style.transition = 'all 0.5s ease-in-out';
                calendarEl.style.opacity = '1';
                calendarEl.style.transform = 'translateY(0)';
            }, 100);
        }
    }

    // Enhanced interactions and animations
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize fade-in animations
        const fadeElements = document.querySelectorAll('.fade-in');
        fadeElements.forEach((element, index) => {
            setTimeout(() => {
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }, index * 100);
        });

        // Enhanced search functionality
        const searchInput = document.getElementById('event-search-input');
        const searchForm = document.getElementById('event-search-form');

        if (searchInput && searchForm) {
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    searchForm.submit();
                }
            });
        }

        // Auto-submit on filter changes
        document.querySelectorAll('.event-filter-dropdown').forEach(function(dropdown) {
            dropdown.addEventListener('change', function() {
                if (searchForm) searchForm.submit();
            });
        });

        // Add smooth hover effects to table rows
        const tableRows = document.querySelectorAll('tbody tr');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.01)';
                this.style.boxShadow = '0 4px 12px rgba(0,0,0,0.1)';
            });

            row.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
                this.style.boxShadow = 'none';
            });
        });

        // Enhanced event card interactions
        const eventCards = document.querySelectorAll('.event-card');
        eventCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px) scale(1.02)';
                this.style.boxShadow = '0 8px 25px rgba(0,0,0,0.15)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
                this.style.boxShadow = '0 1px 3px rgba(0,0,0,0.1)';
            });
        });
    });

    // CSV Import Modal Functions
    function openImportModal() {
        document.getElementById('importModal').classList.remove('hidden');
        document.querySelector('.modal-content').classList.remove('scale-95');
        document.querySelector('.modal-content').classList.add('scale-100');
    }

    function closeImportModal() {
        document.querySelector('.modal-content').classList.remove('scale-100');
        document.querySelector('.modal-content').classList.add('scale-95');
        setTimeout(() => {
            document.getElementById('importModal').classList.add('hidden');
        }, 200);
    }

    function updateFileName(input) {
        const fileName = document.getElementById('fileName');
        if (input.files.length > 0) {
            fileName.textContent = `Selected: ${input.files[0].name}`;
            fileName.classList.remove('hidden');
        } else {
            fileName.classList.add('hidden');
        }
    }

    // Close modal when clicking outside
    document.addEventListener('click', function(event) {
        const modal = document.getElementById('importModal');
        if (event.target === modal) {
            closeImportModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeImportModal();
        }
    });
</script>

<!-- CSV Import Modal -->
<div id="importModal" class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm flex justify-center items-center z-50 hidden">
    <div class="bg-white p-6 rounded-2xl shadow-2xl w-full max-w-md mx-4 relative transform transition-all duration-300 scale-95 modal-content">
        <!-- Close Button -->
        <button onclick="closeImportModal()" class="absolute top-3 right-3 w-8 h-8 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center text-gray-500 hover:text-gray-700 transition-all duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <!-- Header -->
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Import Events</h2>
            <p class="text-gray-600">Upload a CSV file to bulk import events</p>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.events.import') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- File Upload -->
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">CSV File</label>
                <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-blue-400 transition-colors duration-300">
                    <input type="file" name="csv_file" accept=".csv" required class="hidden" id="csvFile" onchange="updateFileName(this)">
                    <label for="csvFile" class="cursor-pointer">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                        </svg>
                        <p class="text-gray-600 font-medium">Click to upload CSV file</p>
                        <p class="text-gray-400 text-sm mt-1">or drag and drop</p>
                    </label>
                    <p id="fileName" class="text-sm text-blue-600 mt-2 hidden"></p>
                </div>
            </div>

            <!-- CSV Format Info -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                <h4 class="font-semibold text-blue-800 mb-2">CSV Format Requirements:</h4>
                <ul class="text-blue-700 text-sm space-y-1">
                    <li>• Required columns: title, description, start_date, end_date, location</li>
                    <li>• Date format: YYYY-MM-DD HH:MM:SS or YYYY-MM-DD</li>
                    <li>• All imported events will be marked as active</li>
                    <li>• Events will be attributed to current admin user</li>
                </ul>
                <div class="mt-3">
                    <a href="{{ route('admin.events.download-template') }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm underline">
                        Download CSV Template
                    </a>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white py-3 rounded-xl font-medium shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-300 flex items-center justify-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span>Import Events</span>
            </button>
        </form>
    </div>
</div>

@endpush
