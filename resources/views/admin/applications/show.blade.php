@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1>Scholarship Application Details</h1>

    <div class="card shadow-sm">
        <div class="card-header">
            Application Tracking Code: {{ $application->tracking_code }}
        </div>
        <div class="card-body">
            <p><strong>Full Name:</strong> {{ $application->full_name }}</p>
            <p><strong>Email:</strong> {{ $application->email }}</p>
            <p><strong>Phone Number:</strong> {{ $application->phone_number }}</p>
            <p><strong>Scholarship Type:</strong> {{ $application->scholarship_type }}</p>
            <p><strong>Status:</strong> {{ $application->status }}</p>
            {{-- Add more application details as needed --}}
        </div>
    </div>

    <a href="{{ route('admin.applications.index') }}" class="btn btn-secondary mt-3">Back to Applications</a>
</div>
@endsection 