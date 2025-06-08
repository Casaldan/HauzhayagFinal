@extends('layouts.app') {{-- Assuming you have an app layout --}}

@section('content')
<div class="container mx-auto px-4 py-16 text-center">
    <svg class="mx-auto h-24 w-24 text-green-500 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    <h1 class="text-3xl font-bold text-gray-800 mb-4">Application Submitted Successfully!</h1>
    <p class="text-lg text-gray-600 mb-8">Thank you for your interest in volunteering. Your application has been received.</p>

    <div class="bg-white p-6 rounded-lg shadow-lg inline-block">
        <p class="text-gray-700 font-semibold text-md mb-2">To check the status of your application, please use the email address you provided when applying.</p>
        <p class="text-sm text-gray-500 mt-2">You can track your application status on our website.</p>
    </div>

    <div class="mt-8">
        <a href="{{ route('volunteer.track') }}" class="text-primary hover:underline font-medium mr-4">
            Track Your Application
        </a>
        <a href="{{ url('/') }}" class="text-gray-600 hover:underline font-medium">
            Go back to Homepage
        </a>
    </div>
</div>
@endsection 