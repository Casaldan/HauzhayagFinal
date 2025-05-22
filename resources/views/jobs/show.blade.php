@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
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
        @if($job->contact_link)
            <p class="text-gray-700 mb-2"><strong>Contact Link:</strong> <a href="{{ $job->contact_link }}" class="text-blue-600 hover:underline" target="_blank">{{ $job->contact_link }}</a></p>
        @endif
        @if($job->salary)
            <p class="text-gray-700 mb-2"><strong>Salary:</strong> {{ $job->salary }}</p>
        @endif
        <p class="text-gray-700 mb-2"><strong>Status:</strong> <span class="px-2 py-1 text-xs rounded
            @if($job->status == 'pending') bg-yellow-100 text-yellow-800
            @elseif($job->status == 'approved') bg-green-100 text-green-800
            @elseif($job->status == 'rejected' || $job->status == 'declined') bg-red-100 text-red-800
            @else bg-gray-100 text-gray-800 @endif">
            {{ ucfirst($job->status) }}
        </span></p>
    </div>
    <a href="{{ url()->previous() }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Back</a>
</div>
@endsection 