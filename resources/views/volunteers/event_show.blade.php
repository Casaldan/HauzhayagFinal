@extends('layouts.app')

@section('content')
<div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    @include('volunteers.sidebar')
    <!-- Main Content -->
    <div class="flex-1 p-6 bg-gray-50 ml-64 overflow-y-auto h-screen">
        <h1 class="text-2xl font-bold mb-4">{{ $event->title }}</h1>
        <div class="mb-4">
            <p class="text-gray-700 mb-2"><strong>Description:</strong> {{ $event->description }}</p>
            <p class="text-gray-700 mb-2"><strong>Start:</strong> {{ \Carbon\Carbon::parse($event->start_date)->format('F j, Y g:i A') }}</p>
            <p class="text-gray-700 mb-2"><strong>End:</strong> {{ \Carbon\Carbon::parse($event->end_date)->format('F j, Y g:i A') }}</p>
            <p class="text-gray-700 mb-2"><strong>Location:</strong> {{ $event->location }}</p>
        </div>
        <a href="{{ route('volunteer.events') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Back to Events</a>
    </div>
</div>
@endsection 