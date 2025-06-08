<x-app-layout>
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

    /* Sticky sidebar styles */
    .sidebar-container {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 16rem; /* 64 = 16rem */
        overflow-y: auto;
    }

    .main-content {
        margin-left: 16rem; /* Same as sidebar width */
        min-height: 100vh;
        width: calc(100% - 16rem);
    }

</style>
<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar Navigation -->
        <div class="w-64 bg-[#1B4B5A] text-white flex flex-col fixed h-full">
            <div class="p-4 flex items-center space-x-2">
                <img src="{{ asset('image/logohauzhayag.jpg') }}"
                             alt="Hauz Hayag Logo"
                             class="h-16 w-auto rounded-lg shadow-md">
                <h1 class="text-2xl font-bold">Hauz Hayag</h1>
            </div>
            <nav class="mt-8">
                <a href="/dashboard" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
                <a href="/users" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    User Management
                </a>
                <a href="/events" class="flex items-center px-4 py-3 bg-[#2C5F6E] hover:bg-[#2C5F6E] transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Events
                </a>
                <a href="/students" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    Applicants
                </a>
                <a href="{{ route('admin.volunteers.index') }}" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Volunteers
                </a>
                <a href="/admin/jobs" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Jobs
                </a>
                <!-- Removed dropdown links -->
                <div class="mt-auto pt-20">
                    <a href="/logout" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors text-red-300 hover:text-red-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Logout
                    </a>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 bg-gray-100 ml-64 overflow-y-auto h-screen p-6">
            <!-- Header -->
            <div class="bg-white p-4 flex justify-between items-center shadow-sm">
                <h2 class="text-xl flex items-center">
                    <svg class="w-6 h-6 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    Events
                </h2>
                <div class="flex items-center space-x-3">
                    <span class="text-gray-600">Admin</span>
                    <div class="w-8 h-8 bg-[#00A4B8] rounded-full flex items-center justify-center text-white font-medium">
                        AD
                    </div>
                </div>
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
</body>
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
                window.location.href = '/events/' + info.event.id;
            }
        });
        calendar.render();
        // Fetch and display upcoming events
        fetch('{{ route("events.upcoming") }}')
            .then(response => response.json())
            .then(events => {
                const upcomingEventsDiv = document.getElementById('upcoming-events');
                events.forEach(event => {
                    const eventEl = document.createElement('div');
                    eventEl.className = 'p-4 border rounded-lg hover:bg-gray-50 cursor-pointer';
                    eventEl.innerHTML = `
                        <h4 class="font-semibold">${event.title}</h4>
                        <p class="text-sm text-gray-600">${new Date(event.start_date).toLocaleDateString()}</p>
                        <p class="text-sm text-gray-500">${event.description}</p>
                    `;
                    eventEl.onclick = () => window.location.href = '/events/' + event.id;
                    upcomingEventsDiv.appendChild(eventEl);
                });
            });
    });
</script>
@endpush
</x-app-layout>