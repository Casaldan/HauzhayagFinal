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
            Edit Volunteer
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
                <h1 class="text-2xl font-bold text-gray-800">Edit Volunteer Details</h1>
                <p class="text-gray-600">Update the volunteer information below</p>
            </div>

            <form action="{{ route('admin.volunteers.update', $volunteer) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Name Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $volunteer->name) }}"
                           class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200"
                           required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $volunteer->email) }}"
                           class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200"
                           required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone', $volunteer->phone) }}"
                           class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200"
                           required>
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status and Start Date Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status" class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200" required>
                            <option value="Active" {{ old('status', $volunteer->status) === 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Pending" {{ old('status', $volunteer->status) === 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Inactive" {{ old('status', $volunteer->status) === 'Inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                        <input type="date" name="start_date" value="{{ old('start_date', $volunteer->start_date ? $volunteer->start_date->format('Y-m-d') : '') }}"
                               class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200"
                               required>
                        @error('start_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Skills Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Skills</label>
                    <textarea name="skills" rows="3"
                              class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200"
                              placeholder="Enter volunteer skills (comma-separated)">{{ old('skills', is_array($volunteer->skills) ? implode(', ', $volunteer->skills) : $volunteer->skills) }}</textarea>
                    @error('skills')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Notes Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                    <textarea name="notes" rows="4"
                              class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200"
                              placeholder="Additional notes about the volunteer">{{ old('notes', $volunteer->notes) }}</textarea>
                    @error('notes')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.volunteers.index') }}"
                       class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all duration-200 btn-hover">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-8 py-3 bg-primary text-white rounded-lg hover:bg-secondary transition-all duration-200 btn-hover font-medium">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Update Volunteer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
