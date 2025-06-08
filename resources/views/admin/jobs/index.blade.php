@extends('layouts.admin')

@push('styles')
<style>
    /* Enhanced hover effects for cards */
    .job-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    /* Enhanced button hover effects */
    .btn-hover:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* Enhanced table styling */
    .table-row:hover {
        background-color: #F8FAFC;
        transform: scale(1.01);
    }

    /* Smooth transitions for all interactive elements */
    .transition-all {
        transition: all 0.3s ease-in-out;
    }
</style>
@endpush

@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="bg-white p-4 flex justify-between items-center shadow-sm rounded-lg mb-6">
        <h2 class="text-xl flex items-center">
            <svg class="w-6 h-6 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            Job Management
        </h2>
        <div class="flex items-center space-x-3">
            <span class="text-gray-600">Admin</span>
            <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white font-medium">
                AD
            </div>
        </div>
    </div>

    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Job Listings</h1>
        <p class="text-gray-600">Manage and organize job postings</p>
    </div>

    <!-- Stats Overview Section -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <!-- Total Jobs -->
        <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-blue-500 job-card transition-all">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Jobs</p>
                    <p class="text-xl font-bold text-gray-800 mt-1">{{ $jobs->count() }}</p>
                </div>
                <div class="rounded-full bg-blue-100 p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Active Jobs -->
        <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-green-500 job-card transition-all">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Active Jobs</p>
                    <p class="text-xl font-bold text-gray-800 mt-1">{{ $jobs->where('status', 'approved')->count() }}</p>
                </div>
                <div class="rounded-full bg-green-100 p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending Jobs -->
        <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-yellow-500 job-card transition-all">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Pending Jobs</p>
                    <p class="text-xl font-bold text-gray-800 mt-1">{{ $jobs->where('status', 'pending')->count() }}</p>
                </div>
                <div class="rounded-full bg-yellow-100 p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Expired Jobs -->
        <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-red-500 job-card transition-all">
            <div class="flex justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Expired Jobs</p>
                    <p class="text-xl font-bold text-gray-800 mt-1">{{ $jobs->where('expires_at', '<', now())->count() }}</p>
                </div>
                <div class="rounded-full bg-red-100 p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Job Button -->
    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.jobs.create') }}" class="bg-secondary text-white px-4 py-2 rounded-lg hover:bg-secondary/80 transition-all btn-hover">
            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add New Job
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job Details</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company & Location</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Expiry Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($jobs as $job)
                        <tr class="table-row transition-all duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center text-primary font-bold">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $job->title ?? $job->role }}</div>
                                        <div class="text-sm text-gray-500">{{ Str::limit($job->description, 60) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $job->company_name ?? $job->company }}</div>
                                <div class="text-sm text-gray-500">{{ $job->location ?? 'Remote' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs rounded-full
                                    {{ $job->status === 'approved' ? 'bg-green-100 text-green-800' :
                                       ($job->status === 'rejected' ? 'bg-red-100 text-red-800' :
                                        'bg-yellow-100 text-yellow-800') }}">
                                    {{ ucfirst($job->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if($job->expires_at)
                                    {{ $job->expires_at->format('M d, Y') }}
                                @else
                                    <span class="text-gray-400">No expiry</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                <a href="#" onclick="editJob({{ $job->id }})" class="bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700 transition-all btn-hover">
                                    Edit
                                </a>
                                <form action="{{ route('admin.jobs.destroy', $job) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this job?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded-lg hover:bg-red-700 transition-all btn-hover">
                                        Delete
                                    </button>
                                </form>
                            </td>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="text-lg font-medium">No jobs found</p>
                                    <p class="text-sm">Get started by creating your first job listing.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function editJob(jobId) {
        // Redirect to edit page
        window.location.href = `/admin/jobs/${jobId}/edit`;
    }

    // Enhanced interactions
    document.addEventListener('DOMContentLoaded', function() {
        // Add confirmation for delete actions
        const deleteButtons = document.querySelectorAll('form[action*="destroy"] button');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                if (!confirm('Are you sure you want to delete this job? This action cannot be undone.')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endpush
