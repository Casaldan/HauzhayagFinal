@extends('layouts.app')

@section('content')
<div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    @include('volunteers.sidebar')
    <!-- Main Content -->
    <div class="flex-1 p-6 bg-gray-50 ml-64 overflow-y-auto h-screen">
        <h1 class="text-2xl font-bold mb-6">Upcoming Events</h1>
        <div class="space-y-4">
            @forelse($events as $event)
                <div class="bg-white rounded-lg shadow p-4 flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-semibold">{{ $event->title }}</h2>
                        <p class="text-gray-600">{{ \Carbon\Carbon::parse($event->start_date)->format('F j, Y g:i A') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('F j, Y g:i A') }}</p>
                        <p class="text-gray-500">{{ Str::limit($event->description, 100) }}</p>
                    </div>
                    <a href="{{ route('volunteer.events.show', $event->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">View Details</a>
                </div>
            @empty
                <div class="text-center text-gray-500 py-4">No upcoming events found.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection 