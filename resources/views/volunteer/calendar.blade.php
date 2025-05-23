@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 w-64 bg-white shadow-lg">
        <div class="flex items-center justify-center h-16 border-b">
            <img src="{{ asset('image/logohauzhayag.jpg') }}" alt="Hauz Hayag Logo" class="h-8 w-auto">
            <span class="ml-2 text-xl font-semibold text-gray-800">Volunteer Portal</span>
        </div>
        <nav class="mt-6">
            <a href="{{ route('volunteer.dashboard') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('volunteer.events') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Events
            </a>
            <a href="{{ route('volunteer.calendar') }}" class="flex items-center px-6 py-3 text-gray-700 bg-gray-100 border-r-4 border-primary">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Calendar
            </a>
            <a href="{{ route('volunteer.jobs') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                Job Listings
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="ml-64 p-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Volunteer Calendar</h1>
            <p class="text-gray-600">View and manage your volunteer schedule</p>
        </div>

        <!-- Calendar and Events Section -->
        <div class="flex-1 p-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
             <!-- Calendar View -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
                <div id="calendar"></div>
            </div>
            <!-- Upcoming Events -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-4">Upcoming Events</h3>
                <div class="space-y-4" id="upcoming-events"></div>
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
            events: '{{ route("events.json") }}', // Assuming this route provides volunteer events as well
            eventClick: function(info) {
                window.location.href = '/volunteer/events/' + info.event.id; // Adjust the route as needed
            }
        });
        calendar.render();

        // Optional: Fetch and display upcoming events in the sidebar/separate section
        // This part depends on whether you have a separate endpoint for upcoming volunteer events
        // If not, you might need to filter events from the main calendar feed

        // Example of fetching and displaying upcoming events (adjust route and logic as needed)
        /*
        fetch('{{ route("volunteer.upcomingEvents") }}') // Replace with your actual route for upcoming volunteer events
            .then(response => response.json())
            .then(events => {
                const upcomingEventsDiv = document.getElementById('upcoming-events'); // Make sure you have an element with this ID
                events.forEach(event => {
                    const eventEl = document.createElement('div');
                    eventEl.className = 'p-4 border rounded-lg hover:bg-gray-50 cursor-pointer';
                    eventEl.innerHTML = `
                        <h4 class="font-semibold">${event.title}</h4>
                        <p class="text-sm text-gray-600">${new Date(event.start_date).toLocaleDateString()}</p>
                        <p class="text-sm text-gray-500">${event.description}</p>
                    `;
                    eventEl.onclick = () => window.location.href = '/volunteer/events/' + event.id; // Adjust the route as needed
                    upcomingEventsDiv.appendChild(eventEl);
                });
            });
        */
    });
</script>
@endpush

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

</style>