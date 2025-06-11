<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Application Status - Hauz Hayag</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#00A4B8',
                        secondary: '#FFB800',
                        neutral: '#F3F4F6',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <style>
        .animate-fade-in {
            animation: fadeIn 0.6s ease-in-out;
        }
        .animate-slide-up {
            animation: slideUp 0.8s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 font-sans min-h-screen">
    <header class="bg-white/95 backdrop-blur-lg shadow-lg fixed w-full top-0 z-50 border-b border-white/20">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('image/logohauzhayag.jpg') }}"
                         alt="Hauz Hayag Logo"
                         class="h-16 w-auto rounded-xl shadow-lg border-2 border-white">
                    <span class="text-2xl font-bold bg-gradient-to-r from-primary to-blue-600 bg-clip-text text-transparent">Hauz Hayag</span>
                </div>
                <a href="/" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-primary to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-indigo-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                    <i class="fas fa-home mr-2"></i>
                    <span>Back to Home</span>
                </a>
            </div>
        </div>
    </header>

    <main class="pt-32 pb-16">
        <div class="max-w-4xl mx-auto px-4">
            <!-- Header Section -->
            <div class="text-center mb-8 animate-fade-in">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-green-400 to-blue-500 rounded-full shadow-lg mb-4">
                    <i class="fas fa-search text-white text-2xl"></i>
                </div>
                <h1 class="text-4xl font-bold bg-gradient-to-r from-primary to-blue-600 bg-clip-text text-transparent mb-2">Application Status</h1>
                <p class="text-gray-600 text-lg">Track your scholarship application progress</p>
            </div>

            <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-2xl p-8 border border-white/20 animate-slide-up">
                <!-- Tracking Code Display -->
                <div class="mb-8 flex items-center justify-center">
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 px-8 py-6 rounded-2xl text-center shadow-lg">
                        <p class="text-sm font-medium text-gray-600 mb-2">Tracking Code</p>
                        <p class="font-mono text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent tracking-wider">{{ $application->tracking_code }}</p>
                    </div>
                </div>

                <!-- Application Information Section -->
                <div class="bg-gradient-to-r from-gray-50 to-blue-50 border border-gray-200 rounded-2xl p-6 mb-8 shadow-lg">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                            <i class="fas fa-user-graduate mr-3 text-primary"></i>
                            Application Information
                        </h2>

                        @if($application->status == 'pending')
                            <span class="bg-gradient-to-r from-yellow-400 to-orange-400 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg flex items-center">
                                <i class="fas fa-clock mr-2"></i>
                                Pending Review
                            </span>
                        @elseif($application->status == 'approved')
                            <span class="bg-gradient-to-r from-green-400 to-emerald-500 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg flex items-center">
                                <i class="fas fa-check-circle mr-2"></i>
                                Approved
                            </span>
                        @elseif($application->status == 'declined')
                            <span class="bg-gradient-to-r from-red-400 to-pink-500 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg flex items-center">
                                <i class="fas fa-times-circle mr-2"></i>
                                Declined
                            </span>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-user text-primary mr-2"></i>
                                <p class="text-gray-600 text-sm font-medium">Applicant Name</p>
                            </div>
                            <p class="font-semibold text-gray-800 text-lg">{{ $application->full_name }}</p>
                        </div>

                        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-envelope text-primary mr-2"></i>
                                <p class="text-gray-600 text-sm font-medium">Email Address</p>
                            </div>
                            <p class="font-semibold text-gray-800">{{ $application->email }}</p>
                        </div>

                        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-phone text-primary mr-2"></i>
                                <p class="text-gray-600 text-sm font-medium">Phone Number</p>
                            </div>
                            <p class="font-semibold text-gray-800">{{ $application->phone_number ?? 'Not provided' }}</p>
                        </div>

                        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-graduation-cap text-primary mr-2"></i>
                                <p class="text-gray-600 text-sm font-medium">Scholarship Type</p>
                            </div>
                            <p class="font-semibold text-gray-800">{{ ucfirst(str_replace('_', ' ', $application->scholarship_type)) }}</p>
                        </div>

                        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-calendar-plus text-primary mr-2"></i>
                                <p class="text-gray-600 text-sm font-medium">Application Date</p>
                            </div>
                            <p class="font-semibold text-gray-800">{{ $application->created_at->format('F d, Y') }}</p>
                        </div>

                        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-clock text-primary mr-2"></i>
                                <p class="text-gray-600 text-sm font-medium">Last Updated</p>
                            </div>
                            <p class="font-semibold text-gray-800">{{ $application->updated_at->format('F d, Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Status Timeline Section -->
                <div class="bg-gradient-to-r from-indigo-50 to-purple-50 border border-indigo-200 rounded-2xl p-6 mb-8 shadow-lg">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-timeline mr-3 text-primary"></i>
                        Status Timeline
                    </h3>
                    <div class="relative pl-12 ml-4">
                        <div class="absolute top-0 left-0 h-full w-1 bg-gradient-to-b from-green-400 to-blue-500 rounded-full"></div>

                        <div class="relative mb-10">
                            <div class="absolute -left-12 mt-2 w-8 h-8 rounded-full bg-gradient-to-r from-green-400 to-emerald-500 border-4 border-white shadow-lg flex items-center justify-center">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                                <span class="text-gray-500 text-sm font-medium">{{ $application->created_at->format('M d, Y - h:i A') }}</span>
                                <h4 class="font-bold text-gray-800 text-lg mt-1">Application Received</h4>
                                <p class="text-gray-600 mt-2">Your application has been successfully submitted and is now in our system.</p>
                            </div>
                        </div>
                        
                        <div class="relative mb-10">
                            <div class="absolute -left-12 mt-2 w-8 h-8 rounded-full {{ $application->status == 'pending' ? 'bg-gradient-to-r from-yellow-400 to-orange-400' : ($application->status == 'approved' || $application->status == 'declined' ? 'bg-gradient-to-r from-blue-400 to-indigo-500' : 'bg-gray-300') }} border-4 border-white shadow-lg flex items-center justify-center">
                                @if($application->status == 'pending')
                                    <i class="fas fa-clock text-white text-sm"></i>
                                @else
                                    <i class="fas fa-search text-white text-sm"></i>
                                @endif
                            </div>
                            <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                                <span class="text-gray-500 text-sm font-medium">{{ $application->updated_at == $application->created_at ? 'In Progress' : $application->updated_at->format('M d, Y - h:i A') }}</span>
                                <h4 class="font-bold text-gray-800 text-lg mt-1">Application Review</h4>
                                <p class="text-gray-600 mt-2">
                                    @if($application->status == 'pending')
                                        Your application is currently being reviewed by our scholarship committee.
                                    @elseif($application->status == 'approved' || $application->status == 'declined')
                                        Your application has been thoroughly reviewed by our team.
                                    @endif
                                </p>
                            </div>
                        </div>
                        
                        <div class="relative">
                            <div class="absolute -left-12 mt-2 w-8 h-8 rounded-full {{ $application->status == 'approved' ? 'bg-gradient-to-r from-green-400 to-emerald-500' : ($application->status == 'declined' ? 'bg-gradient-to-r from-red-400 to-pink-500' : 'bg-gray-300') }} border-4 border-white shadow-lg flex items-center justify-center">
                                @if($application->status == 'approved')
                                    <i class="fas fa-trophy text-white text-sm"></i>
                                @elseif($application->status == 'declined')
                                    <i class="fas fa-times text-white text-sm"></i>
                                @else
                                    <i class="fas fa-hourglass-half text-white text-sm"></i>
                                @endif
                            </div>
                            <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                                <span class="text-gray-500 text-sm font-medium">{{ $application->status == 'pending' ? 'Pending' : $application->updated_at->format('M d, Y - h:i A') }}</span>
                                <h4 class="font-bold text-gray-800 text-lg mt-1">Final Decision</h4>
                                <p class="text-gray-600 mt-2">
                                    @if($application->status == 'pending')
                                        Decision pending. We will notify you via email when the review is complete.
                                    @elseif($application->status == 'approved')
                                        🎉 Congratulations! Your scholarship application has been approved. Please check your email for next steps.
                                    @elseif($application->status == 'declined')
                                        We regret to inform you that your application was not selected for the scholarship at this time.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                @if($application->status == 'approved')
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-green-200 rounded-2xl p-8 mb-8 shadow-lg">
                    <div class="flex items-start">
                        <div class="mr-6">
                            <div class="w-16 h-16 bg-gradient-to-r from-green-400 to-emerald-500 rounded-full flex items-center justify-center shadow-lg">
                                <i class="fas fa-trophy text-white text-2xl"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-green-800 mb-3 flex items-center">
                                🎉 Application Approved!
                            </h3>
                            <p class="text-green-700 text-lg leading-relaxed mb-4">Congratulations! You have been selected as a recipient for our scholarship program. An email with detailed instructions has been sent to your registered email address.</p>
                            <div class="bg-green-100 border border-green-300 rounded-lg p-4">
                                <p class="text-green-800 font-semibold">⏰ Important: Please respond within 7 days to confirm your acceptance.</p>
                            </div>
                        </div>
                    </div>
                </div>
                @elseif($application->status == 'declined')
                <div class="bg-gradient-to-r from-red-50 to-pink-50 border-2 border-red-200 rounded-2xl p-8 mb-8 shadow-lg">
                    <div class="flex items-start">
                        <div class="mr-6">
                            <div class="w-16 h-16 bg-gradient-to-r from-red-400 to-pink-500 rounded-full flex items-center justify-center shadow-lg">
                                <i class="fas fa-heart text-white text-2xl"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-red-800 mb-3">Application Not Selected</h3>
                            <p class="text-red-700 text-lg leading-relaxed mb-4">We appreciate your interest in our scholarship program. Unfortunately, your application was not selected at this time.</p>
                            <div class="bg-red-100 border border-red-300 rounded-lg p-4">
                                <p class="text-red-800 font-semibold">💪 We encourage you to apply again for future opportunities. Don't give up on your dreams!</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Resend Code Section -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-2xl p-8 mb-8 shadow-lg">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-envelope text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Need Your Tracking Code?</h3>
                        <form action="{{ route('scholarship.resend') }}" method="POST" class="max-w-md mx-auto">
                            @csrf
                            <label for="email" class="block mb-3 font-semibold text-gray-700">Enter your email to resend tracking code:</label>
                            <div class="flex flex-col sm:flex-row gap-3">
                                <input type="email" name="email" required
                                       class="flex-1 px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all"
                                       placeholder="Enter your email address">
                                <button type="submit"
                                        class="px-6 py-3 bg-gradient-to-r from-primary to-blue-600 text-white font-semibold rounded-xl hover:from-blue-600 hover:to-indigo-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                                    <i class="fas fa-paper-plane mr-2"></i>
                                    Resend Code
                                </button>
                            </div>
                        </form>

                        @if(session('success'))
                            <div class="bg-green-100 border border-green-300 rounded-xl p-4 mt-4 text-green-700">
                                <i class="fas fa-check-circle mr-2"></i>
                                {{ session('success') }}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="bg-red-100 border border-red-300 rounded-xl p-4 mt-4 text-red-700">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Back to Home Button -->
                <div class="text-center">
                    <a href="/" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-gray-600 to-gray-700 text-white font-semibold rounded-xl hover:from-gray-700 hover:to-gray-800 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                        <i class="fas fa-arrow-left mr-3"></i>
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-gradient-to-r from-green-100 to-blue-100 text-gray-800 py-8 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <div class="flex items-center justify-center mb-4">
                <img src="{{ asset('image/logohauzhayag.jpg') }}" alt="Hauz Hayag Logo" class="h-12 w-auto rounded-lg shadow-md mr-3">
                <span class="text-xl font-bold bg-gradient-to-r from-primary to-blue-600 bg-clip-text text-transparent">Hauz Hayag</span>
            </div>
            <p class="text-sm text-gray-600">
                &copy; {{ date('Y') }} Hauz Hayag Scholarship. All rights reserved. | Empowering communities through education.
            </p>
        </div>
    </footer>

    <script>
        // Add smooth scroll animations
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.animate-slide-up, .animate-fade-in');
            elements.forEach((el, index) => {
                el.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
</body>
</html>