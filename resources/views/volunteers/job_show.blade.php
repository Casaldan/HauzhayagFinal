@extends('layouts.app')

@section('content')
<div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    @include('volunteers.sidebar')
    <!-- Main Content -->
    <!-- Main Content -->
    <div class="flex-1 p-6 bg-gray-50 ml-64 overflow-y-auto h-screen">
        <h1 class="text-2xl font-bold mb-4">{{ $job->title }}</h1>
        <div class="mb-4">
            <p class="text-gray-700 mb-2"><strong>Company:</strong> {{ $job->company_name ?? $job->company }}</p>
            <p class="text-gray-700 mb-2"><strong>Role:</strong> {{ $job->role }}</p>
            <p class="text-gray-700 mb-2"><strong>Description:</strong> {{ $job->description }}</p>
            <p class="text-gray-700 mb-2"><strong>Qualifications:</strong> {{ $job->qualifications }}</p>
            <p class="text-gray-700 mb-2"><strong>Category:</strong> {{ $job->category }}</p>
            <p class="text-gray-700 mb-2"><strong>Type:</strong> {{ $job->type }}</p>
            <p class="text-gray-700 mb-2"><strong>Contact Email:</strong> {{ $job->contact_email }}</p>
            <p class="text-gray-700 mb-2"><strong>Contact Phone:</strong> {{ $job->contact_phone }}</p>
            <p class="text-gray-700 mb-2"><strong>Contact Person:</strong> {{ $job->contact_person }}</p>
            @if($job->salary_min || $job->salary_max)
                <p class="text-gray-700 mb-2"><strong>Salary Range:</strong>
                    @if($job->salary_min && $job->salary_max)
                        ${{ is_numeric($job->salary_min) ? number_format((float)$job->salary_min, 2) : 'N/A' }} - ${{ is_numeric($job->salary_max) ? number_format((float)$job->salary_max, 2) : 'N/A' }}
                    @elseif($job->salary_min)
                        From ${{ is_numeric($job->salary_min) ? number_format((float)$job->salary_min, 2) : 'N/A' }}
                    @else
                        Up to ${{ is_numeric($job->salary_max) ? number_format((float)$job->salary_max, 2) : 'N/A' }}
                    @endif
                </p>
            @endif
            <p class="text-gray-700 mb-2"><strong>Status:</strong> <span class="px-2 py-1 text-xs rounded
                @if($job->status == 'pending') bg-yellow-100 text-yellow-800
                @elseif($job->status == 'approved') bg-green-100 text-green-800
                @elseif($job->status == 'rejected' || $job->status == 'declined') bg-red-100 text-red-800
                @else bg-gray-100 text-gray-800 @endif">
                {{ ucfirst($job->status) }}
            </span></p>
        </div>
        <a href="{{ route('volunteer.jobs') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#2C5F6E] hover:bg-[#2C5F6E]/80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#2C5F6E]">Back to Job Listings</a>
    </div>
</div>
@endsection 