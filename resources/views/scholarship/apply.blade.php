@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50">
    <!-- Header -->
    <header class="bg-white/95 backdrop-blur-md shadow-lg border-b border-primary/10">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4 group">
                    <div class="relative">
                        <img src="{{ asset('image/logohauzhayag.jpg') }}" alt="Hauz Hayag Logo" class="h-14 w-auto rounded-xl shadow-lg group-hover:shadow-xl transition-all duration-300 transform group-hover:scale-105">
                        <div class="absolute inset-0 bg-primary/20 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">Hauz Hayag</h1>
                        <p class="text-sm text-gray-600 font-medium">Scholarship Foundation</p>
                    </div>
                </div>
                <a href="/student/dashboard" class="inline-flex items-center px-4 py-2 bg-primary/10 text-primary rounded-xl hover:bg-primary hover:text-white transition-all duration-300 font-medium">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Dashboard
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-2xl border border-primary/20 overflow-hidden">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-primary to-secondary px-8 py-6">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">Scholarship Application Form</h2>
                        <p class="text-white/80 text-sm">Take the first step towards your educational journey</p>
                    </div>
                </div>
            </div>

            <div class="p-8">
                
                <form action="{{ route('scholarship.apply') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                    @csrf

                    <!-- Personal Information -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-200">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900">Personal Information</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="full_name" class="block text-sm font-semibold text-gray-700">Full Name</label>
                                <input type="text" name="full_name" id="full_name" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-300 bg-white/80 backdrop-blur-sm">
                            </div>
                            <div class="space-y-2">
                                <label for="student_id" class="block text-sm font-semibold text-gray-700">Student ID</label>
                                <input type="text" name="student_id" id="student_id" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-300 bg-white/80 backdrop-blur-sm">
                            </div>
                            <div class="space-y-2">
                                <label for="email" class="block text-sm font-semibold text-gray-700">Email Address</label>
                                <input type="email" name="email" id="email" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-300 bg-white/80 backdrop-blur-sm"
                                    placeholder="example@gmail.com">
                            </div>
                            <div class="space-y-2">
                                <label for="phone_number" class="block text-sm font-semibold text-gray-700">Phone Number</label>
                                <input type="tel" name="phone_number" id="phone_number" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-300 bg-white/80 backdrop-blur-sm"
                                    placeholder="09123456789" maxlength="11" pattern="[0-9]{11}" inputmode="numeric">
                            </div>
                        </div>
                    </div>

                    <!-- Academic Information -->
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-6 border border-green-200">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900">Academic Information</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="gpa" class="block text-sm font-semibold text-gray-700">Current GPA</label>
                                <input type="number" name="gpa" id="gpa" step="0.01" min="0" max="4" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all duration-300 bg-white/80 backdrop-blur-sm">
                            </div>
                            <div class="space-y-2">
                                <label for="major" class="block text-sm font-semibold text-gray-700">Major/Course</label>
                                <input type="text" name="major" id="major" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all duration-300 bg-white/80 backdrop-blur-sm">
                            </div>
                            <div class="space-y-2">
                                <label for="year_level" class="block text-sm font-semibold text-gray-700">Year Level</label>
                                <select name="year_level" id="year_level" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all duration-300 bg-white/80 backdrop-blur-sm">
                                    <option value="">Select Year Level</option>
                                    <option value="1st Year">1st Year</option>
                                    <option value="2nd Year">2nd Year</option>
                                    <option value="3rd Year">3rd Year</option>
                                    <option value="4th Year">4th Year</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label for="expected_graduation" class="block text-sm font-semibold text-gray-700">Expected Graduation</label>
                                <input type="month" name="expected_graduation" id="expected_graduation" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all duration-300 bg-white/80 backdrop-blur-sm">
                            </div>
                        </div>
                    </div>

                    <!-- Scholarship Selection -->
                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl p-6 border border-purple-200">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-8 h-8 bg-purple-600 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900">Scholarship Details</h3>
                        </div>
                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label for="scholarship_type" class="block text-sm font-semibold text-gray-700">Select Scholarship Type</label>
                                <select name="scholarship_type" id="scholarship_type" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition-all duration-300 bg-white/80 backdrop-blur-sm">
                                    <option value="">Choose a scholarship type</option>
                                    <option value="Merit Scholarship">Merit Scholarship</option>
                                    <option value="Research Grant">Research Grant</option>
                                    <option value="Leadership Scholarship">Leadership Scholarship</option>
                                    <option value="STEM Excellence Award">STEM Excellence Award</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label for="why_deserve" class="block text-sm font-semibold text-gray-700">Why do you deserve this scholarship?</label>
                                <textarea name="why_deserve" id="why_deserve" rows="4" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition-all duration-300 bg-white/80 backdrop-blur-sm resize-none"
                                    placeholder="Tell us about your achievements, challenges overcome, and why you're a deserving candidate..."></textarea>
                            </div>
                            <div class="space-y-2">
                                <label for="career_goals" class="block text-sm font-semibold text-gray-700">What are your career goals?</label>
                                <textarea name="career_goals" id="career_goals" rows="4" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition-all duration-300 bg-white/80 backdrop-blur-sm resize-none"
                                    placeholder="Describe your future career aspirations and how this scholarship will help you achieve them..."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Documents Upload -->
                    <div class="bg-gradient-to-r from-orange-50 to-yellow-50 rounded-xl p-6 border border-orange-200">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-8 h-8 bg-orange-600 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m5 5H7a2 2 0 01-2-2V7a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900">Required Documents</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="transcript" class="block text-sm font-semibold text-gray-700">Transcript of Records</label>
                                <input type="file" name="transcript" id="transcript" required
                                    class="w-full px-4 py-3 border-2 border-dashed border-orange-300 rounded-xl focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition-all duration-300 bg-white/80 backdrop-blur-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-500 file:text-white hover:file:bg-orange-600">
                            </div>
                            <div class="space-y-2">
                                <label for="recommendation_letter" class="block text-sm font-semibold text-gray-700">Recommendation Letter</label>
                                <input type="file" name="recommendation_letter" id="recommendation_letter" required
                                    class="w-full px-4 py-3 border-2 border-dashed border-orange-300 rounded-xl focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition-all duration-300 bg-white/80 backdrop-blur-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-500 file:text-white hover:file:bg-orange-600">
                            </div>
                            <div class="space-y-2">
                                <label for="resume" class="block text-sm font-semibold text-gray-700">Resume/CV</label>
                                <input type="file" name="resume" id="resume" required
                                    class="w-full px-4 py-3 border-2 border-dashed border-orange-300 rounded-xl focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition-all duration-300 bg-white/80 backdrop-blur-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-500 file:text-white hover:file:bg-orange-600">
                            </div>
                            <div class="space-y-2">
                                <label for="additional_documents" class="block text-sm font-semibold text-gray-700">Additional Documents (Optional)</label>
                                <input type="file" name="additional_documents" id="additional_documents"
                                    class="w-full px-4 py-3 border-2 border-dashed border-orange-300 rounded-xl focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition-all duration-300 bg-white/80 backdrop-blur-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-500 file:text-white hover:file:bg-orange-600">
                            </div>
                        </div>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="bg-gradient-to-r from-gray-50 to-slate-50 rounded-xl p-6 border border-gray-200">
                        <div class="flex items-start space-x-4">
                            <div class="flex items-center h-5 mt-1">
                                <input type="checkbox" id="terms" name="terms" required class="h-5 w-5 rounded border-2 border-gray-300 text-primary focus:ring-2 focus:ring-primary/20 transition-all duration-300">
                            </div>
                            <div class="flex-1">
                                <label for="terms" class="block text-sm font-semibold text-gray-900 mb-2">Terms and Conditions</label>
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    I agree to the <button type="button" onclick="openTermsModal()" class="text-primary hover:underline font-medium">Terms and Conditions</button> and <button type="button" onclick="openPrivacyModal()" class="text-primary hover:underline font-medium">Privacy Policy</button>. I certify that all information provided in this application is true, complete, and accurate to the best of my knowledge. I understand that providing false information may result in the rejection of my application or revocation of any scholarship awarded. I also understand that my personal information will be used for scholarship application processing and communication purposes only.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center pt-6">
                        <button type="submit" id="submitBtn" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-primary to-secondary text-white font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                            <svg id="submitIcon" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                            <!-- Loading Spinner (hidden by default) -->
                            <svg id="loadingSpinner" class="animate-spin w-5 h-5 mr-2 hidden" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span id="submitText">Submit Application</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const submitBtn = document.getElementById('submitBtn');
    const submitIcon = document.getElementById('submitIcon');
    const loadingSpinner = document.getElementById('loadingSpinner');
    const submitText = document.getElementById('submitText');
    const phoneInput = document.getElementById('phone_number');
    const emailInput = document.getElementById('email');

    // Phone number validation
    if (phoneInput) {
        // Prevent non-numeric input
        phoneInput.addEventListener('keypress', function(e) {
            // Allow only digits (0-9)
            if (!/[0-9]/.test(e.key) && !['Backspace', 'Delete', 'Tab', 'Enter', 'ArrowLeft', 'ArrowRight'].includes(e.key)) {
                e.preventDefault();
            }
        });

        phoneInput.addEventListener('input', function(e) {
            // Remove any non-digit characters
            let value = e.target.value.replace(/\D/g, '');

            // Limit to 11 digits
            if (value.length > 11) {
                value = value.slice(0, 11);
            }

            e.target.value = value;
        });

        phoneInput.addEventListener('blur', function(e) {
            const phone = e.target.value.replace(/\D/g, '');
            if (phone.length !== 11) {
                alert('Phone number must be exactly 11 digits.');
                e.target.focus();
            }
        });

        // Prevent paste of non-numeric content
        phoneInput.addEventListener('paste', function(e) {
            e.preventDefault();
            let paste = (e.clipboardData || window.clipboardData).getData('text');
            let numericOnly = paste.replace(/\D/g, '');
            if (numericOnly.length <= 11) {
                e.target.value = numericOnly;
            }
        });
    }

    // Email validation
    if (emailInput) {
        emailInput.addEventListener('blur', function(e) {
            const email = e.target.value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address.');
                e.target.focus();
            }
        });
    }

    // Terms checkbox validation
    const termsCheckbox = document.getElementById('terms');

    form.addEventListener('submit', function(e) {
        // Validate before submission
        const phone = phoneInput.value.replace(/\D/g, '');
        const email = emailInput.value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (phone.length !== 11) {
            e.preventDefault();
            alert('Phone number must be exactly 11 digits.');
            phoneInput.focus();
            return;
        }

        if (!emailRegex.test(email)) {
            e.preventDefault();
            alert('Please enter a valid email address.');
            emailInput.focus();
            return;
        }

        if (!termsCheckbox.checked) {
            e.preventDefault();
            alert('You must agree to the Terms and Conditions to submit your application.');
            termsCheckbox.focus();
            return;
        }

        // Show loading state
        submitBtn.disabled = true;
        submitIcon.classList.add('hidden');
        loadingSpinner.classList.remove('hidden');
        submitText.textContent = 'Submitting Application...';

        // Add visual feedback
        submitBtn.classList.remove('hover:scale-105');
        submitBtn.classList.add('opacity-75');
    });

    // Modal functions
    function openTermsModal() {
        document.getElementById('termsModal').classList.remove('hidden');
    }

    function closeTermsModal() {
        document.getElementById('termsModal').classList.add('hidden');
    }

    function openPrivacyModal() {
        document.getElementById('privacyModal').classList.remove('hidden');
    }

    function closePrivacyModal() {
        document.getElementById('privacyModal').classList.add('hidden');
    }

    // Close modals when clicking outside
    document.addEventListener('click', function(event) {
        const termsModal = document.getElementById('termsModal');
        const privacyModal = document.getElementById('privacyModal');

        if (event.target === termsModal) {
            closeTermsModal();
        }
        if (event.target === privacyModal) {
            closePrivacyModal();
        }
    });

    // Close modals when pressing Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeTermsModal();
            closePrivacyModal();
        }
    });
});
</script>

<!-- Terms and Conditions Modal -->
<div id="termsModal" class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm flex justify-center items-center z-50 hidden">
    <div class="bg-white p-6 rounded-xl shadow-2xl w-full max-w-2xl mx-4 relative transform transition-all duration-300 scale-95 modal-content max-h-[80vh] overflow-y-auto">
        <!-- Close Button -->
        <button onclick="closeTermsModal()" class="absolute top-3 right-3 w-6 h-6 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center text-gray-500 hover:text-gray-700 transition-all duration-200">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <!-- Header -->
        <div class="text-center mb-6">
            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full flex items-center justify-center mx-auto mb-3">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h2 class="text-xl font-semibold text-gray-800 mb-1">Terms and Conditions</h2>
            <p class="text-sm text-gray-600">Scholarship Application Agreement</p>
        </div>

        <!-- Content -->
        <div class="space-y-4 text-sm text-gray-700 leading-relaxed">
            <div>
                <h3 class="font-semibold text-gray-800 mb-2">1. Application Process</h3>
                <p>By submitting this scholarship application, you agree to provide accurate and complete information. Any false or misleading information may result in disqualification from the scholarship program.</p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-800 mb-2">2. Eligibility Requirements</h3>
                <p>Applicants must meet all specified eligibility criteria for the scholarship program. The organization reserves the right to verify all information provided in the application.</p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-800 mb-2">3. Selection Process</h3>
                <p>Scholarship recipients will be selected based on merit, need, and other criteria as determined by the scholarship committee. The decision of the selection committee is final.</p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-800 mb-2">4. Use of Information</h3>
                <p>Information provided in this application will be used solely for scholarship evaluation and administration purposes. Personal information will be kept confidential and secure.</p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-800 mb-2">5. Obligations of Recipients</h3>
                <p>Scholarship recipients may be required to maintain certain academic standards, participate in program activities, or fulfill other obligations as specified in the scholarship agreement.</p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-800 mb-2">6. Modification of Terms</h3>
                <p>The organization reserves the right to modify these terms and conditions at any time. Applicants will be notified of any significant changes.</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="flex justify-end mt-6 pt-4 border-t border-gray-200">
            <button onclick="closeTermsModal()" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-400 transition-colors duration-200 text-sm font-medium">
                I Understand
            </button>
        </div>
    </div>
</div>

<!-- Privacy Policy Modal -->
<div id="privacyModal" class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm flex justify-center items-center z-50 hidden">
    <div class="bg-white p-6 rounded-xl shadow-2xl w-full max-w-2xl mx-4 relative transform transition-all duration-300 scale-95 modal-content max-h-[80vh] overflow-y-auto">
        <!-- Close Button -->
        <button onclick="closePrivacyModal()" class="absolute top-3 right-3 w-6 h-6 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center text-gray-500 hover:text-gray-700 transition-all duration-200">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <!-- Header -->
        <div class="text-center mb-6">
            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-500 rounded-full flex items-center justify-center mx-auto mb-3">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <h2 class="text-xl font-semibold text-gray-800 mb-1">Privacy Policy</h2>
            <p class="text-sm text-gray-600">How we protect your information</p>
        </div>

        <!-- Content -->
        <div class="space-y-4 text-sm text-gray-700 leading-relaxed">
            <div>
                <h3 class="font-semibold text-gray-800 mb-2">Information We Collect</h3>
                <p>We collect personal information that you provide when applying for scholarships, including your name, email address, phone number, academic records, and other relevant documentation.</p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-800 mb-2">How We Use Your Information</h3>
                <p>Your information is used exclusively for scholarship application processing, evaluation, communication regarding your application status, and program administration.</p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-800 mb-2">Information Security</h3>
                <p>We implement appropriate security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction.</p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-800 mb-2">Information Sharing</h3>
                <p>We do not sell, trade, or otherwise transfer your personal information to third parties without your consent, except as necessary for scholarship program administration.</p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-800 mb-2">Data Retention</h3>
                <p>We retain your information for as long as necessary to fulfill the purposes for which it was collected and to comply with legal requirements.</p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-800 mb-2">Your Rights</h3>
                <p>You have the right to access, update, or request deletion of your personal information. Contact us if you wish to exercise these rights.</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="flex justify-end mt-6 pt-4 border-t border-gray-200">
            <button onclick="closePrivacyModal()" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-400 transition-colors duration-200 text-sm font-medium">
                I Understand
            </button>
        </div>
    </div>
</div>

@endsection