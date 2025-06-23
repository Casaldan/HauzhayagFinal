<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Events - {{ config('app.name', 'Hauz Hayag') }}</title>
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
            background-color: #10b981;
            border-color: #059669;
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

        /* Pulse animation for highlighted events */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.02); box-shadow: 0 0 20px rgba(34, 197, 94, 0.3); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body class="bg-gray-100 font-['Inter']">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <x-sidebar role="volunteer" currentRoute="{{ request()->route()->getName() ?? 'volunteer.events' }}" />

        <!-- Main Content -->
        <div class="flex-1 ml-64 overflow-y-auto">
            <div class="p-8">
                <!-- Header -->
                <div class="bg-white p-6 flex justify-between items-center shadow-sm rounded-lg mb-8">
                    <div>
                        <h2 class="text-2xl font-bold flex items-center text-gray-800">
                            <svg class="w-7 h-7 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Events & Calendar
                        </h2>
                        <p class="text-gray-600 mt-1">Discover and register for upcoming events</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </div>
                </div>

                <!-- Calendar and Events Section -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                    <!-- Calendar View -->
                    <div class="lg:col-span-2 bg-white rounded-xl shadow-lg p-6 card-hover">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Event Calendar
                        </h3>
                        <div id="calendar"></div>
                    </div>
                    <!-- Quick Event Overview -->
                    <div class="bg-white rounded-xl shadow-lg p-6 card-hover">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Quick Overview
                        </h3>
                        <div class="space-y-4">
                            @if(isset($events) && $events->count() > 0)
                                @foreach($events->take(3) as $event)
                                <div class="p-3 border border-gray-200 rounded-lg hover:bg-green-50 cursor-pointer transition-all duration-300" onclick="scrollToEvent({{ $event->id }})">
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

                <!-- Events List -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                    <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Available Events
                    </h3>
                    <div class="grid gap-4">
                        @forelse($events as $event)
                        <div id="event-{{ $event->id }}" class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl shadow-lg p-6 card-hover border-l-4 border-green-500">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-start justify-between mb-4">
                                        <div>
                                            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $event->title }}</h3>
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
                                        </div>
                                    </div>

                                    <!-- Event Description -->
                                    <p class="text-gray-700 mb-4">{{ \Illuminate\Support\Str::limit($event->description, 200) }}</p>

                                    <!-- Action Buttons -->
                                    <div class="flex justify-end space-x-3">
                                        <button onclick="openEventDetailsModal({{ $event->id }})" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-all duration-300 hover-scale flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            View Details
                                        </button>
                                        <button onclick="openRegistrationModal({{ $event->id }}, '{{ $event->title }}')" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition-all duration-300 hover-scale flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                            </svg>
                                            Register Now
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-500 mb-2">No events available</h3>
                            <p class="text-gray-400">Check back later for new events!</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Registration Modal -->
<div id="registrationModal" class="fixed inset-0 bg-black bg-opacity-50 justify-center items-center z-50 hidden">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md mx-4 relative">
        <button onclick="closeRegistrationModal()" class="absolute top-4 right-4 text-gray-400 hover:text-black text-2xl font-bold">&times;</button>
        <h2 class="text-2xl font-bold mb-6 text-center">Register for Event</h2>
        <p id="eventTitle" class="text-center text-gray-600 mb-6"></p>

        <form id="registrationForm" class="space-y-4" enctype="multipart/form-data">
            <input type="hidden" id="eventId" name="event_id">

            <div>
                <label for="fullName" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                <input type="text" id="fullName" name="full_name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" value="{{ auth()->user()->name }}">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                <input type="email" id="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" value="{{ auth()->user()->email }}">
            </div>

            <div>
                <label for="phoneNumber" class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                <input type="tel" id="phoneNumber" name="phone_number" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
            </div>

            <div>
                <label for="applicationReason" class="block text-sm font-medium text-gray-700 mb-2">Why do you want to volunteer for this event? *</label>
                <textarea id="applicationReason" name="application_reason" rows="4" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="Tell us why you're interested in volunteering for this event..."></textarea>
            </div>

            <div>
                <label for="volunteerDescription" class="block text-sm font-medium text-gray-700 mb-2">Describe yourself as a volunteer *</label>
                <textarea id="volunteerDescription" name="volunteer_description" rows="3" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="Tell us about your skills, experience, and what makes you a good volunteer..."></textarea>
            </div>

            <div>
                <label for="validId" class="block text-sm font-medium text-gray-700 mb-2">Upload Valid ID *</label>
                <input type="file" id="validId" name="valid_id" required accept="image/*,.pdf" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                <p class="text-xs text-gray-500 mt-1">Please upload a clear photo or scan of your valid government-issued ID (Driver's License, Passport, National ID, etc.). Accepted formats: JPG, PNG, PDF. Max size: 5MB.</p>
            </div>

            <!-- Terms and Conditions -->
            <div class="bg-gradient-to-r from-gray-50 to-slate-50 rounded-lg p-4 border border-gray-200">
                <div class="flex items-start space-x-3">
                    <div class="flex items-center h-5 mt-1">
                        <input type="checkbox" id="volunteer_terms_agreement" name="terms_agreement" required
                               class="h-4 w-4 rounded border-2 border-gray-300 text-green-500 focus:ring-2 focus:ring-green-100 focus:border-green-400 transition-all duration-300">
                    </div>
                    <div class="flex-1">
                        <label for="volunteer_terms_agreement" class="block text-sm font-semibold text-gray-800 mb-2 cursor-pointer">
                            I agree to the <a href="{{ route('terms.volunteer') }}" target="_blank" class="text-green-600 hover:underline font-medium">Terms and Conditions</a> and <a href="{{ route('privacy.policy') }}" target="_blank" class="text-green-600 hover:underline font-medium">Privacy Policy</a> <span class="text-red-500">*</span>
                        </label>
                        <div class="text-xs text-gray-600 leading-relaxed">
                            <p class="mb-2">By checking this box, I acknowledge that:</p>
                            <ul class="list-disc list-inside space-y-1 ml-2">
                                <li>All information provided is accurate and complete</li>
                                <li>I understand the volunteer requirements and responsibilities</li>
                                <li>I agree to comply with all event policies and volunteer guidelines</li>
                                <li>I consent to the processing of my personal data for volunteer registration purposes</li>
                                <li>False information may result in application rejection or volunteer exclusion</li>
                                <li>I understand that volunteer assignments may be subject to change</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-4 pt-4">
                <button type="button" onclick="closeRegistrationModal()" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Cancel
                </button>
                <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">
                    Submit Application
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Event Details Modal -->
<div id="eventDetailsModal" class="fixed inset-0 bg-black bg-opacity-50 justify-center items-center z-50 hidden">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-2xl mx-4 relative max-h-[90vh] overflow-y-auto">
        <button onclick="closeEventDetailsModal()" class="absolute top-4 right-4 text-gray-400 hover:text-black text-2xl font-bold">&times;</button>
        <h2 class="text-2xl font-bold mb-6 text-center">Event Details</h2>

        <div id="eventDetailsContent" class="space-y-4">
            <!-- Event details will be loaded here -->
        </div>

        <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200 mt-6">
            <button onclick="closeEventDetailsModal()" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                Close
            </button>
            <button onclick="registerFromDetails()" class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">
                Register for this Event
            </button>
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
                        // Scroll to the event in the list
                        const eventId = info.event.id;
                        const eventElement = document.getElementById('event-' + eventId);
                        if (eventElement) {
                            eventElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            eventElement.style.animation = 'pulse 2s';
                        }
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

        function scrollToEvent(eventId) {
            const eventElement = document.getElementById('event-' + eventId);
            if (eventElement) {
                eventElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                eventElement.style.animation = 'pulse 2s';
            }
        }

        let currentEventId = null;
        let currentEventTitle = null;

        function openRegistrationModal(eventId, eventTitle) {
            currentEventId = eventId;
            currentEventTitle = eventTitle;
            document.getElementById('eventId').value = eventId;
            document.getElementById('eventTitle').textContent = eventTitle;
            document.getElementById('registrationModal').classList.remove('hidden');
            document.getElementById('registrationModal').classList.add('flex');
        }

        function closeRegistrationModal() {
            document.getElementById('registrationModal').classList.add('hidden');
            document.getElementById('registrationModal').classList.remove('flex');
            document.getElementById('registrationForm').reset();
        }

        function openEventDetailsModal(eventId) {
            currentEventId = eventId;
            // Fetch event details
            fetch(`/api/events/${eventId}`)
                .then(response => response.json())
                .then(event => {
                    currentEventTitle = event.title;
                    const content = `
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">${event.title}</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div class="flex items-center text-gray-600">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span><strong>Start:</strong> ${new Date(event.start_date).toLocaleDateString('en-US', {
                                            year: 'numeric',
                                            month: 'long',
                                            day: 'numeric',
                                            hour: '2-digit',
                                            minute: '2-digit'
                                        })}</span>
                                    </div>
                                    <div class="flex items-center text-gray-600">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span><strong>End:</strong> ${new Date(event.end_date).toLocaleDateString('en-US', {
                                            year: 'numeric',
                                            month: 'long',
                                            day: 'numeric',
                                            hour: '2-digit',
                                            minute: '2-digit'
                                        })}</span>
                                    </div>
                                </div>
                                <div class="flex items-center text-gray-600 mb-4">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span><strong>Location:</strong> ${event.location}</span>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800 mb-2">Description</h4>
                                <p class="text-gray-700 leading-relaxed">${event.description}</p>
                            </div>
                            ${event.what_are_we_looking_for ? `
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800 mb-2 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                    What Are We Looking For?
                                </h4>
                                <div class="bg-orange-50 border border-orange-200 rounded-lg p-4">
                                    <p class="text-gray-700 leading-relaxed">${event.what_are_we_looking_for}</p>
                                </div>
                            </div>
                            ` : ''}
                        </div>
                    `;
                    document.getElementById('eventDetailsContent').innerHTML = content;
                    document.getElementById('eventDetailsModal').classList.remove('hidden');
                    document.getElementById('eventDetailsModal').classList.add('flex');
                })
                .catch(error => {
                    console.error('Error fetching event details:', error);
                    alert('Error loading event details. Please try again.');
                });
        }

        function closeEventDetailsModal() {
            document.getElementById('eventDetailsModal').classList.add('hidden');
            document.getElementById('eventDetailsModal').classList.remove('flex');
        }

        function registerFromDetails() {
            closeEventDetailsModal();
            openRegistrationModal(currentEventId, currentEventTitle);
        }

        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Validate terms and conditions
            const termsCheckbox = document.getElementById('volunteer_terms_agreement');
            if (!termsCheckbox.checked) {
                alert('You must agree to the Terms and Conditions to submit your application.');
                termsCheckbox.focus();
                return;
            }

            // Validate file upload
            const fileInput = document.getElementById('validId');
            if (!fileInput.files || fileInput.files.length === 0) {
                alert('Please upload a valid ID.');
                fileInput.focus();
                return;
            }

            // Check file size (5MB limit)
            const file = fileInput.files[0];
            if (file.size > 5 * 1024 * 1024) {
                alert('File size must be less than 5MB.');
                fileInput.focus();
                return;
            }

            const formData = new FormData(this);

            fetch('/volunteer/event-registration', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const trackingCode = data.tracking_code;
                    const message = `Application submitted successfully!\n\nYour tracking code is: ${trackingCode}\n\nPlease check your email for confirmation and save this tracking code to check your application status.`;
                    alert(message);

                    // Show tracking code modal or redirect to tracking page
                    if (confirm('Would you like to track your application status now?')) {
                        window.open(`/volunteer/track-application?code=${trackingCode}`, '_blank');
                    }

                    closeRegistrationModal();
                    location.reload(); // Refresh to show updated status
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
        });
    </script>
</body>
</html>