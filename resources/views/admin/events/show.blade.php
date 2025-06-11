@extends('layouts.admin')

@push('styles')
<style>
    /* Enhanced card styling */
    .event-detail-card {
        transition: all 0.3s ease-in-out;
    }

    .event-detail-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Event Details
        </h2>
        <div class="flex items-center space-x-3">
            <span class="text-gray-600">Admin</span>
            <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white font-medium">
                AD
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">{{ $event->title }}</h1>
            <p class="text-gray-600">Viewing event information and details</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('events.index') }}"
               class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition-all btn-hover">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Events
            </a>
            <a href="{{ route('events.edit', $event) }}"
               class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-secondary transition-all btn-hover">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Event
            </a>
        </div>
    </div>

    <!-- Event Details Card -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden event-detail-card">
        <div class="p-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Event Information -->
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Event Information
                        </h3>
                        <div class="space-y-4">
                            <div class="border-l-4 border-primary pl-4">
                                <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Event Title</h4>
                                <p class="mt-1 text-xl font-semibold text-gray-900">{{ $event->title }}</p>
                            </div>
                            <div class="border-l-4 border-secondary pl-4">
                                <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Description</h4>
                                <p class="mt-1 text-gray-700 leading-relaxed">{{ $event->description }}</p>
                            </div>
                            <div class="border-l-4 border-green-500 pl-4">
                                <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Location</h4>
                                <p class="mt-1 text-gray-700">{{ $event->location ?? 'Location TBD' }}</p>
                            </div>
                            <div class="border-l-4 border-blue-500 pl-4">
                                <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Status</h4>
                                <span class="mt-1 inline-flex px-3 py-1 text-sm rounded-full
                                    @if($event->status == 'active') bg-green-100 text-green-800
                                    @elseif($event->status == 'completed') bg-blue-100 text-blue-800
                                    @elseif($event->status == 'cancelled') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst($event->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Date and Time Information -->
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Date and Time
                        </h3>
                        <div class="space-y-4">
                            <div class="border-l-4 border-yellow-500 pl-4">
                                <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Start Date & Time</h4>
                                <p class="mt-1 text-lg font-medium text-gray-900">{{ $event->start_date->format('F j, Y') }}</p>
                                <p class="text-gray-600">{{ $event->start_date->format('g:i A') }}</p>
                            </div>
                            <div class="border-l-4 border-red-500 pl-4">
                                <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">End Date & Time</h4>
                                <p class="mt-1 text-lg font-medium text-gray-900">{{ $event->end_date->format('F j, Y') }}</p>
                                <p class="text-gray-600">{{ $event->end_date->format('g:i A') }}</p>
                            </div>
                            <div class="border-l-4 border-purple-500 pl-4">
                                <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Duration</h4>
                                <p class="mt-1 text-gray-700">{{ $event->start_date->diffForHumans($event->end_date, true) }}</p>
                            </div>
                            <div class="border-l-4 border-indigo-500 pl-4">
                                <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Created</h4>
                                <p class="mt-1 text-gray-700">{{ $event->created_at->format('F j, Y g:i A') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                    <h4 class="text-lg font-medium text-red-800 mb-2">Danger Zone</h4>
                    <p class="text-sm text-red-600 mb-4">Once you delete an event, there is no going back. Please be certain.</p>
                    <form action="{{ route('events.destroy', $event) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-all btn-hover"
                                onclick="return confirm('Are you sure you want to delete this event? This action cannot be undone.')">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Delete Event
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection