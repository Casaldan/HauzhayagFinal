<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Volunteer Application</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .primary-color { background-color: #2C5F6E; }
        .primary-hover { background-color: #1e4a56; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-16">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Track Your Volunteer Application</h1>
            <p class="text-lg text-gray-600">Enter your tracking code to check your application status</p>
        </div>

        <!-- Tracking Form -->
        <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg mb-8">
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('volunteer.event-application.track') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="tracking_code" class="block text-sm font-medium text-gray-700 mb-2">
                        Tracking Code
                    </label>
                    <input 
                        type="text" 
                        id="tracking_code" 
                        name="tracking_code" 
                        value="{{ request('code') }}"
                        required
                        maxlength="8"
                        placeholder="Enter 8-character code"
                        class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-center text-lg font-mono tracking-wider uppercase"
                        style="letter-spacing: 0.2em;"
                    >
                    <p class="text-sm text-gray-500 mt-2">
                        The tracking code was sent to your email when you submitted your application.
                    </p>
                </div>
                
                <button 
                    type="submit"
                    class="w-full primary-color text-white py-3 px-4 rounded-md hover:primary-hover transition-colors duration-200 font-medium"
                >
                    Track Application
                </button>
            </form>
        </div>

        <!-- Application Details (if found) -->
        @isset($application)
            <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
                <!-- Header with Status -->
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-gray-800">Application Details</h2>
                        <span class="px-3 py-1 rounded-full text-sm font-medium
                            {{ $application->status === 'approved' ? 'bg-green-100 text-green-800' : 
                               ($application->status === 'rejected' ? 'bg-red-100 text-red-800' : 
                                'bg-yellow-100 text-yellow-800') }}">
                            {{ ucfirst($application->status) }}
                        </span>
                    </div>
                </div>

                <!-- Application Information -->
                <div class="p-6 space-y-6">
                    <!-- Personal Information -->
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Full Name</label>
                            <p class="text-lg text-gray-800">{{ $application->full_name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Email</label>
                            <p class="text-lg text-gray-800">{{ $application->email }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Phone Number</label>
                            <p class="text-lg text-gray-800">{{ $application->phone_number }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tracking Code</label>
                            <p class="text-lg text-gray-800 font-mono">{{ $application->tracking_code }}</p>
                        </div>
                    </div>

                    <!-- Event Information -->
                    <div class="border-t pt-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Event Information</h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Event Title</label>
                                <p class="text-lg text-gray-800">{{ $application->event->title }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Event Date</label>
                                <p class="text-lg text-gray-800">{{ $application->event->start_date->format('F j, Y') }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-500">Location</label>
                                <p class="text-lg text-gray-800">{{ $application->event->location }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Application Reason -->
                    <div class="border-t pt-6">
                        <label class="block text-sm font-medium text-gray-500 mb-2">Application Reason</label>
                        <p class="text-gray-800 leading-relaxed">{{ $application->application_reason }}</p>
                    </div>

                    <!-- Admin Notes (if any) -->
                    @if($application->admin_notes)
                        <div class="border-t pt-6">
                            <label class="block text-sm font-medium text-gray-500 mb-2">Admin Notes</label>
                            <div class="bg-gray-50 p-4 rounded-md">
                                <p class="text-gray-800">{{ $application->admin_notes }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Application Timeline -->
                    <div class="border-t pt-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Application Timeline</h3>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-blue-500 rounded-full mr-3"></div>
                                <div>
                                    <p class="text-gray-800 font-medium">Application Submitted</p>
                                    <p class="text-sm text-gray-500">{{ $application->created_at->format('F j, Y g:i A') }}</p>
                                </div>
                            </div>
                            
                            @if($application->status !== 'pending')
                                <div class="flex items-center">
                                    <div class="w-3 h-3 {{ $application->status === 'approved' ? 'bg-green-500' : 'bg-red-500' }} rounded-full mr-3"></div>
                                    <div>
                                        <p class="text-gray-800 font-medium">Application {{ ucfirst($application->status) }}</p>
                                        <p class="text-sm text-gray-500">{{ $application->updated_at->format('F j, Y g:i A') }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Status-specific Information -->
                    @if($application->status === 'approved')
                        <div class="border-t pt-6">
                            <div class="bg-green-50 border border-green-200 rounded-md p-4">
                                <h3 class="text-lg font-semibold text-green-800 mb-2">🎉 Congratulations!</h3>
                                <p class="text-green-700">
                                    Your volunteer application has been approved! You will receive additional information about the event closer to the date.
                                </p>
                            </div>
                        </div>
                    @elseif($application->status === 'rejected')
                        <div class="border-t pt-6">
                            <div class="bg-red-50 border border-red-200 rounded-md p-4">
                                <h3 class="text-lg font-semibold text-red-800 mb-2">Application Update</h3>
                                <p class="text-red-700">
                                    Thank you for your interest. Unfortunately, we are unable to accept your application at this time.
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="border-t pt-6">
                            <div class="bg-yellow-50 border border-yellow-200 rounded-md p-4">
                                <h3 class="text-lg font-semibold text-yellow-800 mb-2">⏳ Under Review</h3>
                                <p class="text-yellow-700">
                                    Your application is currently being reviewed by our team. You will be notified via email once a decision has been made.
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endisset

        <!-- Back to Home -->
        <div class="text-center mt-8">
            <a href="{{ url('/') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                ← Back to Home
            </a>
        </div>
    </div>

    <script>
        // Auto-format tracking code input
        document.getElementById('tracking_code').addEventListener('input', function(e) {
            e.target.value = e.target.value.toUpperCase();
        });
    </script>
</body>
</html>
