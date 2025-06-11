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
<div class="flex-1 flex flex-col items-center justify-center py-8">
    <div class="w-full max-w-xl">
        <div class="bg-white rounded-lg shadow p-8 form-container">
            <div class="mb-6 border-b pb-4">
                <h2 class="text-2xl font-bold text-gray-800">Edit Event</h2>
                <p class="text-gray-500 text-sm mt-1">Update the event details below.</p>
            </div>
            <!-- FORM STARTS: all fields, names, and logic untouched -->
            <form action="{{ route('events.update', $event) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Event Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $event->title) }}" required class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1B4B5A] focus:ring-[#1B4B5A] transition-all duration-300">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date & Time</label>
                        <input type="datetime-local" name="start_date" id="start_date" value="{{ old('start_date', $event->start_date->format('Y-m-d\TH:i')) }}" required class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1B4B5A] focus:ring-[#1B4B5A] transition-all duration-300">
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700">End Date & Time</label>
                        <input type="datetime-local" name="end_date" id="end_date" value="{{ old('end_date', $event->end_date->format('Y-m-d\TH:i')) }}" required class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1B4B5A] focus:ring-[#1B4B5A] transition-all duration-300">
                    </div>
                </div>
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                    <input type="text" name="location" id="location" value="{{ old('location', $event->location) }}" required class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1B4B5A] focus:ring-[#1B4B5A] transition-all duration-300">
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="4" required class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1B4B5A] focus:ring-[#1B4B5A] transition-all duration-300">{{ old('description', $event->description) }}</textarea>
                </div>
                <div class="flex justify-end space-x-3 pt-2">
                    <a href="{{ route('events.show', $event) }}" class="btn-hover inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B4B5A] transition-all duration-300">Cancel</a>
                    <button type="submit" class="btn-hover inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#1B4B5A] hover:bg-[#25697e] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B4B5A] transition-all duration-300">Update Event</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
