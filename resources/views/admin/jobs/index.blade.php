@extends('layouts.admin')

@push('styles')
<style>
    /* Professional Dashboard Styles */
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .stat-card {
        transition: all 0.3s ease-in-out;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: rgba(0, 124, 186, 0.1);
        transition: left 0.5s;
    }

    .stat-card:hover::before {
        left: 100%;
    }

    .stat-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }

    .fade-in {
        animation: fadeInUp 0.6s ease-out forwards;
        opacity: 0;
        transform: translateY(30px);
    }

    .fade-in-delay-1 { animation-delay: 0.1s; }
    .fade-in-delay-2 { animation-delay: 0.2s; }
    .fade-in-delay-3 { animation-delay: 0.3s; }
    .fade-in-delay-4 { animation-delay: 0.4s; }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .hover-lift {
        transition: all 0.3s ease-in-out;
    }

    .hover-lift:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .gradient-text {
        color: #007cba;
    }

    .dashboard-gradient {
        background: #007cba;
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Enhanced Header -->
    <div class="dashboard-gradient text-white p-6 lg:p-8 mb-8">
        <div class="max-w-7xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="text-sm mb-4 opacity-90">
                <ol class="flex items-center space-x-2">
                    <li><a href="{{ route('admin.dashboard') }}" class="hover:text-blue-200 transition-colors">Dashboard</a></li>
                    <li><svg class="w-4 h-4 mx-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></li>
                    <li class="text-blue-200">Job Management</li>
                </ol>
            </nav>

            <!-- Header Content -->
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center space-y-4 lg:space-y-0">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2M8 6v10a2 2 0 002 2h4a2 2 0 002-2V6"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl lg:text-4xl font-bold mb-2">Job Management</h1>
                        <p class="text-blue-100 text-lg">Manage and organize job postings</p>
                    </div>
                </div>

                <!-- Add Job Button -->
                <a href="{{ route('admin.jobs.create') }}" class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-6 py-3 rounded-xl transition-all duration-300 font-medium backdrop-blur-sm border border-white border-opacity-20 hover:scale-105 flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Add New Job</span>
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 lg:px-8 -mt-16 relative z-10">

        <!-- Enhanced Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Jobs -->
            <div class="glass-card stat-card fade-in fade-in-delay-1 rounded-2xl p-6 hover-lift">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Total Jobs</p>
                        <p class="text-3xl font-bold gradient-text">{{ $jobs->count() }}</p>
                        <p class="text-xs text-gray-500 mt-1">All job listings</p>
                    </div>
                    <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2M8 6v10a2 2 0 002 2h4a2 2 0 002-2V6"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Active Jobs -->
            <div class="glass-card stat-card fade-in fade-in-delay-2 rounded-2xl p-6 hover-lift">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Active Jobs</p>
                        <p class="text-3xl font-bold text-green-600">{{ $jobs->where('status', 'approved')->count() }}</p>
                        <p class="text-xs text-gray-500 mt-1">Currently live</p>
                    </div>
                    <div class="w-14 h-14 bg-green-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pending Jobs -->
            <div class="glass-card stat-card fade-in fade-in-delay-3 rounded-2xl p-6 hover-lift">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Pending Jobs</p>
                        <p class="text-3xl font-bold text-yellow-600">{{ $jobs->where('status', 'pending')->count() }}</p>
                        <p class="text-xs text-gray-500 mt-1">Awaiting approval</p>
                    </div>
                    <div class="w-14 h-14 bg-yellow-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Expired Jobs -->
            <div class="glass-card stat-card fade-in fade-in-delay-4 rounded-2xl p-6 hover-lift">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 mb-1">Expired Jobs</p>
                        <p class="text-3xl font-bold text-red-600">{{ $jobs->where('expires_at', '<', now())->count() }}</p>
                        <p class="text-xs text-gray-500 mt-1">Past deadline</p>
                    </div>
                    <div class="w-14 h-14 bg-red-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="glass-card rounded-2xl p-4 mb-6 border-l-4 border-green-500 bg-green-50 bg-opacity-50">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Pending Jobs Alert -->
        @php
            $pendingJobsCount = $jobs->where('status', 'pending')->count();
        @endphp

        @if($pendingJobsCount > 0)
            <div class="glass-card rounded-2xl p-6 mb-6 border-l-4 border-yellow-500 bg-yellow-50 bg-opacity-50">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-yellow-500 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold text-yellow-800 mb-1">Pending Approvals</h3>
                        <p class="text-yellow-700">
                            <strong>{{ $pendingJobsCount }}</strong> job{{ $pendingJobsCount > 1 ? 's' : '' }} awaiting your review.
                            <span class="font-medium">Please review and approve volunteer-submitted job listings below.</span>
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Enhanced Jobs Table -->
        <div class="glass-card rounded-2xl overflow-hidden shadow-xl">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Job Listings</h3>
                <p class="text-sm text-gray-600">Manage all job postings and applications</p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Job Details</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Company & Location</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Expiry Date</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($jobs as $job)
                            <tr class="hover:bg-gray-50 transition-all duration-200 {{ $job->status === 'pending' ? 'bg-yellow-50 border-l-4 border-yellow-400' : '' }}">
                                <td class="px-6 py-6">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 rounded-xl bg-blue-600 flex items-center justify-center text-white font-bold shadow-lg">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2M8 6v10a2 2 0 002 2h4a2 2 0 002-2V6"/>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-semibold text-gray-900">{{ $job->title ?? $job->role }}</div>
                                            <div class="text-sm text-gray-600 mt-1">{{ Str::limit($job->description, 60) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-6">
                                    <div class="text-sm font-medium text-gray-900">{{ $job->company_name ?? $job->company }}</div>
                                    <div class="text-sm text-gray-600 mt-1">{{ $job->location ?? 'Remote' }}</div>
                                </td>
                                <td class="px-6 py-6">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                        {{ $job->status === 'approved' ? 'bg-green-100 text-green-800 border border-green-200' :
                                           ($job->status === 'rejected' ? 'bg-red-100 text-red-800 border border-red-200' :
                                            'bg-yellow-100 text-yellow-800 border border-yellow-200') }}">
                                        @if($job->status === 'approved')
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                        @elseif($job->status === 'rejected')
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                            </svg>
                                        @else
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                            </svg>
                                        @endif
                                        {{ ucfirst($job->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-6 text-sm text-gray-600">
                                    @if($job->expires_at)
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            {{ $job->expires_at->format('M d, Y') }}
                                        </div>
                                    @else
                                        <span class="text-gray-400 italic">No expiry</span>
                                    @endif
                                </td>
                                <td class="px-6 py-6">
                                    <div class="flex items-center justify-end space-x-2">
                                        @if($job->status === 'pending')
                                            <!-- Approve Button -->
                                            <form action="{{ route('admin.jobs.approve', $job) }}" method="POST" class="inline-block">
                                                @csrf
                                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-xl transition-all duration-300 font-medium shadow-lg hover:shadow-xl hover:scale-105 flex items-center space-x-2">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                    </svg>
                                                    <span>Approve</span>
                                                </button>
                                            </form>

                                            <!-- Reject Button -->
                                            <form action="{{ route('admin.jobs.reject', $job) }}" method="POST" class="inline-block">
                                                @csrf
                                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-xl transition-all duration-300 font-medium shadow-lg hover:shadow-xl hover:scale-105 flex items-center space-x-2">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                    <span>Reject</span>
                                                </button>
                                            </form>
                                        @endif

                                        <!-- Edit Button -->
                                        <a href="{{ route('admin.jobs.edit', $job) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl transition-all duration-300 font-medium shadow-lg hover:shadow-xl hover:scale-105 flex items-center space-x-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            <span>Edit</span>
                                        </a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('admin.jobs.destroy', $job) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this job?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-xl transition-all duration-300 font-medium shadow-lg hover:shadow-xl hover:scale-105 flex items-center space-x-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                <span>Delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2M8 6v10a2 2 0 002 2h4a2 2 0 002-2V6"/>
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-900 mb-2">No jobs found</h3>
                                        <p class="text-gray-600 mb-6">Get started by creating your first job listing.</p>
                                        <a href="{{ route('admin.jobs.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl transition-all duration-300 font-medium shadow-lg hover:shadow-xl hover:scale-105 flex items-center space-x-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                            </svg>
                                            <span>Create First Job</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>


    // Enhanced interactions and animations
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize fade-in animations
        const fadeElements = document.querySelectorAll('.fade-in');
        fadeElements.forEach((element, index) => {
            setTimeout(() => {
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }, index * 100);
        });

        // Enhanced confirmation dialogs
        const deleteButtons = document.querySelectorAll('form[action*="destroy"] button');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                if (confirm('⚠️ Are you sure you want to delete this job?\n\nThis action cannot be undone and will permanently remove the job listing.')) {
                    this.closest('form').submit();
                }
            });
        });

        const approveButtons = document.querySelectorAll('form[action*="approve"] button');
        approveButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                if (confirm('✅ Approve this job listing?\n\nThis will make the job visible to all users on the platform.')) {
                    this.closest('form').submit();
                }
            });
        });

        const rejectButtons = document.querySelectorAll('form[action*="reject"] button');
        rejectButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                if (confirm('❌ Reject this job listing?\n\nThis action cannot be undone and the job will not be published.')) {
                    this.closest('form').submit();
                }
            });
        });

        // Add smooth hover effects to table rows
        const tableRows = document.querySelectorAll('tbody tr');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.01)';
                this.style.boxShadow = '0 4px 12px rgba(0,0,0,0.1)';
            });

            row.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
                this.style.boxShadow = 'none';
            });
        });

        // Animate pending jobs
        const pendingRows = document.querySelectorAll('tr.bg-yellow-50');
        pendingRows.forEach(row => {
            row.style.animation = 'pendingPulse 3s ease-in-out infinite';
        });

        // Auto-hide success messages
        const successMessage = document.querySelector('.border-green-500');
        if (successMessage) {
            setTimeout(() => {
                successMessage.style.opacity = '0';
                successMessage.style.transform = 'translateY(-20px)';
                setTimeout(() => {
                    successMessage.remove();
                }, 300);
            }, 5000);
        }
    });
</script>

<style>
    @keyframes pendingPulse {
        0%, 100% {
            background-color: rgb(254 252 232);
            border-left-color: rgb(245 158 11);
        }
        50% {
            background-color: rgb(255 251 235);
            border-left-color: rgb(251 191 36);
        }
    }

    /* Enhanced button animations */
    .hover-lift {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .hover-lift:hover {
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    /* Smooth table row transitions */
    tbody tr {
        transition: all 0.2s ease-in-out;
    }

    /* Glass effect enhancement */
    .glass-card {
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
    }
</style>
@endpush
