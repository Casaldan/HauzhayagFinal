<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Application Status - {{ $application->tracking_code }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .primary-color { background-color: #2C5F6E; }
        .primary-hover { background-color: #1e4a56; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Volunteer Application Status</h1>
            <p class="text-gray-600">Tracking Code: <span class="font-mono font-semibold">{{ $application->tracking_code }}</span></p>
        </div>

        <!-- Application Status Card -->
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Status Header -->
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">Application Details</h2>
                    <span class="px-4 py-2 rounded-full text-sm font-medium
                        {{ $application->status === 'approved' ? 'bg-green-100 text-green-800' : 
                           ($application->status === 'rejected' ? 'bg-red-100 text-red-800' : 
                            'bg-yellow-100 text-yellow-800') }}">
                        {{ ucfirst($application->status) }}
                    </span>
                </div>
            </div>

            <!-- Application Content -->
            <div class="p-6 space-y-6">
                <!-- Personal Information -->
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Personal Information</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Full Name</label>
                                <p class="text-gray-800">{{ $application->full_name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Email</label>
                                <p class="text-gray-800">{{ $application->email }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Phone Number</label>
                                <p class="text-gray-800">{{ $application->phone_number }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Event Information</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Event Title</label>
                                <p class="text-gray-800">{{ $application->event->title }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Event Date</label>
                                <p class="text-gray-800">{{ $application->event->start_date->format('F j, Y') }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Location</label>
                                <p class="text-gray-800">{{ $application->event->location }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Application Reason -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Application Reason</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-800 leading-relaxed">{{ $application->application_reason }}</p>
                    </div>
                </div>

                <!-- Admin Notes (if any) -->
                @if($application->admin_notes)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Admin Notes</h3>
                        <div class="bg-blue-50 border border-blue-200 p-4 rounded-lg">
                            <p class="text-blue-800">{{ $application->admin_notes }}</p>
                        </div>
                    </div>
                @endif

                <!-- Application Timeline -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Application Timeline</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-4 h-4 bg-blue-500 rounded-full mt-1 mr-4"></div>
                            <div>
                                <p class="font-medium text-gray-800">Application Submitted</p>
                                <p class="text-sm text-gray-500">{{ $application->created_at->format('F j, Y g:i A') }}</p>
                            </div>
                        </div>
                        
                        @if($application->status !== 'pending')
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-4 h-4 {{ $application->status === 'approved' ? 'bg-green-500' : 'bg-red-500' }} rounded-full mt-1 mr-4"></div>
                                <div>
                                    <p class="font-medium text-gray-800">Application {{ ucfirst($application->status) }}</p>
                                    <p class="text-sm text-gray-500">{{ $application->updated_at->format('F j, Y g:i A') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Status-specific Information -->
                @if($application->status === 'approved')
                    <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                        <div class="flex items-center mb-3">
                            <svg class="w-6 h-6 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="text-lg font-semibold text-green-800">Congratulations!</h3>
                        </div>
                        <p class="text-green-700 mb-4">
                            Your volunteer application has been approved! We're excited to have you join our team for this event.
                        </p>
                        <div class="text-green-700">
                            <p class="font-medium mb-2">Next Steps:</p>
                            <ul class="list-disc list-inside space-y-1 text-sm">
                                <li>You will receive additional information about the event closer to the date</li>
                                <li>Please mark your calendar for {{ $application->event->start_date->format('F j, Y') }}</li>
                                <li>If you have any questions, please don't hesitate to contact us</li>
                            </ul>
                        </div>
                    </div>
                @elseif($application->status === 'rejected')
                    <div class="bg-red-50 border border-red-200 rounded-lg p-6">
                        <div class="flex items-center mb-3">
                            <svg class="w-6 h-6 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                            <h3 class="text-lg font-semibold text-red-800">Application Update</h3>
                        </div>
                        <p class="text-red-700">
                            Thank you for your interest in volunteering for our event. Unfortunately, we are unable to accept your application at this time. We encourage you to apply for future volunteer opportunities.
                        </p>
                    </div>
                @else
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                        <div class="flex items-center mb-3">
                            <svg class="w-6 h-6 text-yellow-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="text-lg font-semibold text-yellow-800">Under Review</h3>
                        </div>
                        <p class="text-yellow-700">
                            Your application is currently being reviewed by our team. You will be notified via email once a decision has been made.
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Actions -->
        <div class="max-w-4xl mx-auto mt-8 text-center space-y-4">
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('volunteer.event-application.track.form') }}" 
                   class="inline-flex items-center px-6 py-3 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Track Another Application
                </a>
                
                <a href="{{ url('/') }}" 
                   class="inline-flex items-center px-6 py-3 primary-color text-white rounded-lg hover:primary-hover transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Back to Home
                </a>
            </div>
            
            <p class="text-sm text-gray-500">
                Keep this tracking code for your records: <span class="font-mono font-semibold">{{ $application->tracking_code }}</span>
            </p>
        </div>
    </div>
</body>
</html>
