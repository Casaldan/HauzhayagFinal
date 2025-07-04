@extends('layouts.admin')

@push('styles')
<style>
    /* Enhanced form styling */
    .form-container {
        transition: all 0.3s ease-in-out;
    }

    .form-input:focus {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .btn-hover:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
</style>
@endpush

@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="bg-white p-4 flex justify-between items-center shadow-sm rounded-lg mb-6">
        <h2 class="text-xl flex items-center">
            <svg class="w-6 h-6 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            Edit User
        </h2>
        <div class="flex items-center space-x-3">
            <span class="text-gray-600">Admin</span>
            <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white font-medium">
                AD
            </div>
        </div>
    </div>

    <!-- Form Container -->
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-sm p-8 form-container">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Edit User Details</h1>
                <p class="text-gray-600">Update the user information below</p>
            </div>

            <!-- Display success message -->
            @if (session('success'))
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Volunteer Approval Special Notice -->
            @if (session('volunteer_approved') || request('from') === 'volunteer_approval')
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div class="ml-3 flex-1">
                            <h3 class="text-lg font-medium text-blue-800 mb-2">
                                <i class="fas fa-user-check mr-2"></i>
                                Volunteer Account Management
                            </h3>
                            <div class="text-sm text-blue-700 space-y-2">
                                @if (session('volunteer_kept_in_directory'))
                                    <p class="font-medium">✅ This volunteer was approved and is now active in both the volunteer directory and user management.</p>
                                    <p>🔄 The volunteer remains visible in the volunteer directory and can now access the system with this user account.</p>
                                @else
                                    <p class="font-medium">This user account was created from an approved volunteer application.</p>
                                @endif

                                @if (session('default_password') || request('default_password'))
                                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 mt-3">
                                        <div class="flex items-center">
                                            <svg class="h-5 w-5 text-yellow-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                            </svg>
                                            <div>
                                                <p class="font-medium text-yellow-800">Default Password Assigned</p>
                                                <p class="text-yellow-700">
                                                    Current password: <code class="bg-yellow-100 px-2 py-1 rounded font-mono">{{ session('default_password') ?: request('default_password') ?: 'volunteer123' }}</code>
                                                </p>
                                                <p class="text-yellow-700 text-xs mt-1">⚠️ Please update the password below for security.</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="mt-4">
                                    <h4 class="font-medium text-blue-800 mb-2">Recommended Actions:</h4>
                                    <ul class="list-disc list-inside space-y-1 text-blue-700">
                                        <li>✅ Verify the user's contact information</li>
                                        <li>🔑 Set a secure password (or ask the volunteer to change it on first login)</li>
                                        <li>📱 Confirm the phone number is correct</li>
                                        <li>👤 Ensure the role is set to "Volunteer"</li>
                                        <li>✅ Verify the status is "Active"</li>
                                    </ul>
                                </div>

                                <div class="mt-4 flex space-x-3">
                                    <a href="{{ route('admin.volunteers.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                        </svg>
                                        Back to Volunteers
                                    </a>
                                    <a href="{{ route('admin.volunteer-applications.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        View Applications
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Display validation errors -->
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">There were errors with your submission:</h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Name Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                           class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 @error('name') border-red-500 @enderror"
                           required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                           class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 @error('email') border-red-500 @enderror"
                           required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" name="password" placeholder="Leave blank to keep current password"
                           class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 @error('password') border-red-500 @enderror">
                    <p class="text-sm text-gray-500 mt-1">Only fill this field if you want to change the password</p>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role and Status Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                        <select name="role" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 @error('role') border-red-500 @enderror" required>
                            <option value="student" {{ old('role', $user->role) === 'student' ? 'selected' : '' }}>Student</option>
                            <option value="volunteer" {{ old('role', $user->role) === 'volunteer' ? 'selected' : '' }}>Volunteer</option>
                            <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('role')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 @error('status') border-red-500 @enderror" required>
                            <option value="active" {{ old('status', $user->status) === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $user->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Class Year Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Class Year</label>
                    <select name="class_year" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 @error('class_year') border-red-500 @enderror">
                        <option value="">Select Class Year</option>
                        @php
                            $currentYear = date('Y');
                            $startYear = 2009;
                        @endphp
                        @for($year = $currentYear; $year >= $startYear; $year--)
                            <option value="{{ $year }}" {{ old('class_year', $user->class_year) == $year ? 'selected' : '' }}>Class of {{ $year }}</option>
                        @endfor
                    </select>
                    @error('class_year')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone Number Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                    <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number ?? '') }}"
                           class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 @error('phone_number') border-red-500 @enderror"
                           placeholder="Enter phone number">
                    @error('phone_number')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Scholarship Type Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Scholarship Type</label>
                    <select name="scholarship_type" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 @error('scholarship_type') border-red-500 @enderror">
                        <option value="">Select Scholarship Type</option>
                        <option value="home_based" {{ old('scholarship_type', $user->scholarship_type) === 'home_based' ? 'selected' : '' }}>Community-Based</option>
                        <option value="in_house" {{ old('scholarship_type', $user->scholarship_type) === 'in_house' ? 'selected' : '' }}>In-House</option>
                    </select>
                    @error('scholarship_type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                    <a href="{{ route('users.index') }}"
                       class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all duration-200 btn-hover">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Cancel
                    </a>
                    <button type="submit" id="updateBtn"
                            class="px-8 py-3 bg-primary text-white rounded-lg hover:bg-secondary transition-all duration-200 btn-hover font-medium">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span id="btnText">Update User</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const updateBtn = document.getElementById('updateBtn');
    const btnText = document.getElementById('btnText');

    // Check if coming from volunteer approval
    const urlParams = new URLSearchParams(window.location.search);
    const fromVolunteerApproval = urlParams.get('from') === 'volunteer_approval';
    const isNewUser = urlParams.get('new_user') === 'true';
    const defaultPassword = urlParams.get('default_password');

    if (fromVolunteerApproval) {
        // Highlight the password field if it's a new user
        if (isNewUser && defaultPassword) {
            const passwordField = document.querySelector('input[name="password"]');
            if (passwordField) {
                passwordField.focus();
                passwordField.style.borderColor = '#f59e0b';
                passwordField.style.boxShadow = '0 0 0 3px rgba(245, 158, 11, 0.1)';
                passwordField.placeholder = 'Current: ' + defaultPassword + ' - Enter new password';
            }
        }

        // Show additional guidance
        console.log('User editing from volunteer approval:', {
            isNewUser: isNewUser,
            defaultPassword: defaultPassword
        });
    }

    console.log('Form found:', form);
    console.log('Update button found:', updateBtn);

    form.addEventListener('submit', function(e) {
        console.log('Form submitted');
        console.log('Form action:', form.action);
        console.log('Form method:', form.method);

        // Check if all required fields are filled
        const requiredFields = form.querySelectorAll('[required]');
        let allValid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                console.log('Empty required field:', field.name);
                allValid = false;
            }
        });

        if (!allValid) {
            console.log('Form validation failed');
            return;
        }

        // Disable the button to prevent double submission
        updateBtn.disabled = true;
        updateBtn.classList.add('opacity-50', 'cursor-not-allowed');
        btnText.textContent = 'Updating...';

        console.log('Form is being submitted...');

        // Re-enable after 5 seconds in case of issues
        setTimeout(function() {
            updateBtn.disabled = false;
            updateBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            btnText.textContent = 'Update User';
            console.log('Button re-enabled');
        }, 5000);
    });

    // Add click event listener to button for additional debugging
    updateBtn.addEventListener('click', function(e) {
        console.log('Update button clicked');
    });
});
</script>
@endpush

@endsection