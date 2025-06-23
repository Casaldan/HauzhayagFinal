@extends('layouts.admin')

@section('title', 'Create Event')

@section('content')
<div class="p-6 lg:p-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Create New Event</h1>
                <p class="text-gray-600 mt-2">Fill in the details below to add a new event.</p>
            </div>
            <a href="{{ route('events.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all duration-300">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Events
            </a>
        </div>
    </div>

    <!-- Form Container -->
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
            <div class="p-8">
                <div class="mb-8 border-b border-gray-200 pb-6">
                    <h2 class="text-xl font-semibold text-gray-800">Event Information</h2>
                    <p class="text-gray-600 text-sm mt-1">Provide the basic details for your event.</p>
                </div>
                <!-- FORM STARTS: all fields, names, and logic untouched -->
                <form action="{{ route('events.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Event Title</label>
                        <input type="text" name="title" id="title" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-300"
                               placeholder="Enter event title">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Start Date & Time</label>
                            <input type="datetime-local" name="start_date" id="start_date" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-300">
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">End Date & Time</label>
                            <input type="datetime-local" name="end_date" id="end_date" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-300">
                        </div>
                    </div>

                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <input type="text" name="location" id="location" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-300"
                               placeholder="Enter event location">
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea name="description" id="description" rows="4" required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-300 resize-none"
                                  placeholder="Describe the event details..."></textarea>
                    </div>

                    <div>
                        <label for="what_are_we_looking_for" class="block text-sm font-medium text-gray-700 mb-2">
                            What Are We Looking For? <span class="text-red-500">*</span>
                        </label>
                        <textarea name="what_are_we_looking_for" id="what_are_we_looking_for" rows="4" required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-300 resize-none"
                                  placeholder="Describe what kind of volunteers or participants you are looking for..."></textarea>
                        @error('what_are_we_looking_for')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('events.index') }}"
                           class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 bg-white rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-300">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Cancel
                        </a>
                        <button type="submit"
                                class="inline-flex items-center px-6 py-3 bg-primary text-white rounded-lg hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-300 shadow-lg hover:shadow-xl">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Create Event
                        </button>
                    </div>
                </form>
                <!-- FORM ENDS -->
            </div>
        </div>
    </div>
</div>
@endsection