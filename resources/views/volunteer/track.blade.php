@extends('layouts.app') {{-- Assuming you have an app layout --}}

@section('content')
<div class="container mx-auto px-4 py-16">
    <h1 class="text-2xl font-bold text-center mb-8">Track Volunteer Application Status</h1>

    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
        <form action="{{ route('volunteer.track') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" id="email" name="email" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
            </div>
            <button type="submit"
                    class="w-full px-4 py-2 text-sm font-medium text-white bg-primary rounded-md hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                Track Status
            </button>
        </form>

        @isset($application)
            <div class="mt-8 p-6 bg-gray-100 rounded-md">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Application Details</h3>
                <div class="space-y-2">
                    <p><strong>Name:</strong> {{ $application->full_name }}</p>
                    <p><strong>Event:</strong> {{ $application->event->title }}</p>
                    <p><strong>Status:</strong> 
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $application->status === 'approved' ? 'bg-green-100 text-green-800' : 
                               ($application->status === 'rejected' ? 'bg-red-100 text-red-800' : 
                                'bg-yellow-100 text-yellow-800') }}">
                            {{ ucfirst($application->status) }}
                        </span>
                    </p>
                    <p><strong>Applied At:</strong> {{ $application->created_at->format('M d, Y H:i') }}</p>
                </div>
            </div>
        @endisset

        @if(request()->method() === 'POST' && !isset($application))
            <div class="mt-8 p-4 bg-yellow-100 rounded-md text-yellow-800">
                No application found with that email address.
            </div>
        @endif

    </div>
</div>
@endsection 