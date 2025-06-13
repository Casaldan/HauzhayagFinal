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
    </style>
</head>
<body class="bg-gray-100 font-['Inter']">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <x-sidebar role="volunteer" currentRoute="{{ request()->route()->getName() ?? 'events' }}" />

        <!-- Main Content -->
        <div class="flex-1 ml-64 overflow-y-auto">
            <div class="p-8">
                <!-- Header -->
                <div class="bg-white p-6 flex justify-between items-center shadow-sm rounded-lg mb-8">
                    <div>
                        <h2 class="text-2xl font-bold flex items-center text-gray-800">
                            <svg class="w-7 h-7 mr-3 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Volunteer Events
                        </h2>
                        <p class="text-gray-600 mt-1">Find and join upcoming volunteer opportunities</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('volunteer.dashboard') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-opacity-90 transition-all duration-300 hover-scale flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Back to Dashboard
                        </a>
                        <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </div>
                </div>

                <!-- Search and Filter -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <input type="text" placeholder="Search events..." class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                        <div class="flex gap-4">
                            <select class="px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                                <option value="">All Categories</option>
                                <option value="community">Community Service</option>
                                <option value="education">Education</option>
                                <option value="health">Health & Wellness</option>
                                <option value="environment">Environment</option>
                            </select>
                            <select class="px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                                <option value="">All Locations</option>
                                <option value="onsite">On-site</option>
                                <option value="remote">Remote</option>
                                <option value="hybrid">Hybrid</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Events Grid -->
                @if($events->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($events as $event)
                            <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <span class="px-3 py-1 text-sm font-semibold text-green-800 bg-green-100 rounded-full">
                                            {{ ucfirst($event->status) }}
                                        </span>
                                        <span class="text-sm text-gray-600">{{ $event->start_date ? \Carbon\Carbon::parse($event->start_date)->format('M d, Y') : 'TBD' }}</span>
                                    </div>

                                    <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $event->title }}</h3>
                                    <p class="text-gray-600 mb-4 line-clamp-3">{{ Str::limit($event->description, 120) }}</p>

                                    @if($event->location)
                                        <div class="flex items-center text-sm text-gray-600 mb-4">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            {{ $event->location }}
                                        </div>
                                    @endif

                                    @if($event->start_date && $event->end_date)
                                        <div class="flex items-center text-sm text-gray-600 mb-4">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ \Carbon\Carbon::parse($event->start_date)->format('g:i A') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('g:i A') }}
                                        </div>
                                    @endif

                                    <div class="flex space-x-2">
                                        <a href="{{ route('volunteer.events.show', $event->id) }}" class="flex-1 px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-all duration-300 hover-scale flex items-center justify-center">
                                            <span>View Details</span>
                                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </a>
                                        @if(in_array($event->id, $userApplications ?? []))
                                            <button disabled class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg cursor-not-allowed flex items-center justify-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                <span>Applied</span>
                                            </button>
                                        @else
                                            <button onclick="applyToEvent({{ $event->id }}, '{{ $event->title }}')" class="flex-1 px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all duration-300 hover-scale flex items-center justify-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                                </svg>
                                                <span>Apply Now</span>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white rounded-xl shadow-lg p-8 text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No Events Available</h3>
                        <p class="text-gray-600">There are currently no active events available. Please check back later.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>



    <script>
        // Automatic application function using existing user data
        function applyToEvent(eventId, eventTitle) {
            // Show loading state
            const button = event.target.closest('button');
            const originalText = button.innerHTML;
            button.innerHTML = '<svg class="w-4 h-4 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg><span>Applying...</span>';
            button.disabled = true;

            // Automatically apply using existing user account information
            fetch('/volunteer/events/apply-auto', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    event_id: eventId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message with tracking code
                    alert('Application submitted successfully!\n\nEvent: ' + eventTitle + '\nYour tracking code is: ' + data.tracking_code + '\n\nYou can use this code to track your application status.');

                    // Update button to show applied state
                    button.innerHTML = '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg><span>Applied</span>';
                    button.classList.remove('bg-primary', 'hover:bg-opacity-90');
                    button.classList.add('bg-green-600', 'hover:bg-green-700');
                    button.disabled = true;
                } else {
                    // Show error message
                    alert(data.message || 'Failed to submit application. Please try again.');

                    // Restore button
                    button.innerHTML = originalText;
                    button.disabled = false;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while submitting your application. Please try again.');

                // Restore button
                button.innerHTML = originalText;
                button.disabled = false;
            });
        }

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