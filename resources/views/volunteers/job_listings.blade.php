@extends('layouts.app')

@section('content')
<div class="flex h-screen overflow-hidden">
    @include('volunteers.sidebar')
    <div class="flex-1 p-6 bg-gray-50 ml-64 overflow-y-auto h-screen">
        <h1 class="text-2xl font-bold mb-6">Job Listings</h1>
        <h2 class="text-lg font-semibold mb-2">Admin-Posted Jobs</h2>
        <div class="space-y-4 mb-8">
            @forelse($adminJobs as $job)
                <div class="bg-white rounded-lg shadow p-4 flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-semibold">{{ $job->title }}</h2>
                        <p class="text-gray-600">{{ $job->company_name ?? $job->company }}</p>
                        <p class="text-gray-500">{{ Str::limit($job->description, 100) }}</p>
                    </div>
                    <a href="{{ route('jobs.show', $job) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">View Details</a>
                </div>
            @empty
                <div class="text-center text-gray-500 py-4">No admin jobs found.</div>
            @endforelse
        </div>
        <h2 class="text-lg font-semibold mb-2">My Submitted Jobs</h2>
        <div class="space-y-4">
            @forelse($myJobs as $job)
                <div class="bg-blue-50 border border-blue-200 rounded-lg shadow p-4 flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-semibold">{{ $job->title }}</h2>
                        <p class="text-gray-600">{{ $job->company_name ?? $job->company }}</p>
                        <p class="text-gray-500">{{ Str::limit($job->description, 100) }}</p>
                        <span class="px-2 py-1 text-xs rounded
                            @if($job->status == 'pending') bg-yellow-100 text-yellow-800
                            @elseif($job->status == 'approved') bg-green-100 text-green-800
                            @elseif($job->status == 'rejected' || $job->status == 'declined') bg-red-100 text-red-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ ucfirst($job->status) }}
                        </span>
                    </div>
                    <a href="{{ route('jobs.show', $job) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">View Details</a>
                </div>
            @empty
                <div class="text-center text-gray-500 py-4">You have not submitted any jobs yet.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection 