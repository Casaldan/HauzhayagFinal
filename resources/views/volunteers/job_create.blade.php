@extends('layouts.app')

@section('content')
<div class="flex h-screen overflow-hidden">
    @include('volunteers.sidebar')
    <div class="flex-1 p-6 bg-gray-50 ml-64 overflow-y-auto h-screen">
        <h1 class="text-2xl font-bold mb-6">Add a Job Listing</h1>
        <form action="{{ route('volunteer.jobs.store') }}" method="POST" class="space-y-6 bg-white p-6 rounded shadow max-w-2xl">
            @csrf
            <div>
                <label class="block font-medium mb-1">Your Name</label>
                <input type="text" name="poster_name" value="{{ old('poster_name', auth()->user()->name) }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block font-medium mb-1">Company Name</label>
                <input type="text" name="company_name" value="{{ old('company_name') }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block font-medium mb-1">Role / Position</label>
                <input type="text" name="role" value="{{ old('role') }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block font-medium mb-1">Salary Price</label>
                <input type="text" name="salary" value="{{ old('salary') }}" class="w-full border rounded px-3 py-2" placeholder="e.g. 20000-30000 or Negotiable" required>
            </div>
            <div>
                <label class="block font-medium mb-1">Job Description</label>
                <textarea name="description" class="w-full border rounded px-3 py-2" rows="4" required>{{ old('description') }}</textarea>
            </div>
            <div>
                <label class="block font-medium mb-1">Qualifications</label>
                <textarea name="qualifications" class="w-full border rounded px-3 py-2" rows="3" required>{{ old('qualifications') }}</textarea>
            </div>
            <div>
                <label class="block font-medium mb-1">Contact Email</label>
                <input type="email" name="contact_email" value="{{ old('contact_email') }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block font-medium mb-1">Contact Phone</label>
                <input type="text" name="contact_phone" value="{{ old('contact_phone') }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium mb-1">Contact Person</label>
                <input type="text" name="contact_person" value="{{ old('contact_person') }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block font-medium mb-1">Contact Link (Website or Social)</label>
                <input type="url" name="contact_link" value="{{ old('contact_link') }}" class="w-full border rounded px-3 py-2" placeholder="https://example.com">
            </div>
            <div>
                <label class="block font-medium mb-1">Category</label>
                <input type="text" name="category" value="{{ old('category') }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block font-medium mb-1">Type</label>
                <select name="type" class="w-full border rounded px-3 py-2" required>
                    <option value="">Select type</option>
                    <option value="Full-time">Full-time</option>
                    <option value="Part-time">Part-time</option>
                    <option value="Contract">Contract</option>
                    <option value="Temporary">Temporary</option>
                    <option value="Internship">Internship</option>
                </select>
            </div>
            <div class="flex space-x-2">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">Submit</button>
                <a href="{{ route('volunteer.dashboard') }}" class="bg-gray-300 text-gray-800 px-6 py-2 rounded hover:bg-gray-400 inline-block text-center">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection 