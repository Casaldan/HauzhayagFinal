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
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
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
                    <li class="text-blue-200">Student Management</li>
                </ol>
            </nav>

            <!-- Header Content -->
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center space-y-4 lg:space-y-0">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl lg:text-4xl font-bold mb-2">Student Management</h1>
                        <p class="text-blue-100 text-lg">Manage applicants and active students</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 lg:px-8 -mt-16 relative z-10">

        <!-- Enhanced Tab Navigation -->
        <div class="glass-card rounded-2xl mb-8 overflow-hidden">
            <nav class="flex bg-gray-100" aria-label="Tabs">
                <button onclick="showTab('applicants')" id="applicants-tab" class="tab-button flex-1 border-b-4 border-blue-500 text-blue-600 py-4 px-6 text-sm font-semibold transition-all duration-300 ease-in-out flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span>Applicants</span>
                </button>
                <button onclick="showTab('students')" id="students-tab" class="tab-button flex-1 border-b-4 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 py-4 px-6 text-sm font-semibold transition-all duration-300 ease-in-out flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <span>Students</span>
                </button>
            </nav>
        </div>

        <!-- Tab Content -->
        <div id="applicants-content" class="tab-content">
            <!-- Enhanced Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Pending Applications -->
                <div class="glass-card stat-card fade-in fade-in-delay-1 rounded-2xl p-6 hover-lift">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Pending Applications</p>
                            <p class="text-3xl font-bold text-yellow-600">{{ $pendingApplicationsCount ?? 0 }}</p>
                            <p class="text-xs text-gray-500 mt-1">Awaiting review</p>
                        </div>
                        <div class="w-14 h-14 bg-yellow-500 rounded-2xl flex items-center justify-center shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Approved Applications -->
                <div class="glass-card stat-card fade-in fade-in-delay-2 rounded-2xl p-6 hover-lift">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Approved Applications</p>
                            <p class="text-3xl font-bold text-green-600">{{ $approvedApplicationsCount ?? 0 }}</p>
                            <p class="text-xs text-gray-500 mt-1">Successfully approved</p>
                        </div>
                        <div class="w-14 h-14 bg-green-500 rounded-2xl flex items-center justify-center shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Active Students -->
                <div class="glass-card stat-card fade-in fade-in-delay-3 rounded-2xl p-6 hover-lift">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Active Students</p>
                            <p class="text-3xl font-bold gradient-text">{{ $activeStudentsCount ?? 0 }}</p>
                            <p class="text-xs text-gray-500 mt-1">Currently enrolled</p>
                        </div>
                        <div class="w-14 h-14 bg-blue-500 rounded-2xl flex items-center justify-center shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Search and Filter Tools -->
            <div class="glass-card rounded-2xl p-6 mb-8">
                <form id="student-search-form" method="GET" class="flex flex-col lg:flex-row gap-4">
                    <!-- Search Input -->
                    <div class="relative flex-grow">
                        <input
                            type="text"
                            name="search"
                            id="student-search-input"
                            placeholder="Search applicants by name or email..."
                            value="{{ request('search') }}"
                            class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white shadow-sm transition-all duration-300"
                        >
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Status Filter -->
                    <div class="relative">
                        <select name="status" class="appearance-none pl-4 pr-10 py-3 border border-gray-200 bg-white rounded-xl text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm student-filter-dropdown shadow-sm transition-all duration-300 min-w-[140px]">
                            <option value="">All Statuses</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-400">
                            <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Type Filter -->
                    <div class="relative">
                        <select name="type" class="appearance-none pl-4 pr-10 py-3 border border-gray-200 bg-white rounded-xl text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm student-filter-dropdown shadow-sm transition-all duration-300 min-w-[160px]">
                            <option value="">All Types</option>
                            <option value="community_based" {{ request('type') == 'community_based' ? 'selected' : '' }}>Community-based</option>
                            <option value="in_house" {{ request('type') == 'in_house' ? 'selected' : '' }}>In-house</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-400">
                            <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Clear Filters Button -->
                    @if(request()->hasAny(['search', 'status', 'type']))
                        <a href="{{ route('admin.students.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-3 rounded-xl transition-all duration-300 font-medium flex items-center space-x-2 min-w-fit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            <span>Clear</span>
                        </a>
                    @endif
                </form>
            </div>

            <!-- Enhanced Applicants Table -->
            <div class="glass-card rounded-2xl overflow-hidden shadow-xl">
                <div class="bg-gray-100 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Pending Applications</h3>
                    <p class="text-sm text-gray-600">Review and manage scholarship applications</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Applicant</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Contact</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Transcript</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse($applications as $application)
                                @if ($application->status === 'pending')
                                    <tr class="hover:bg-gray-50 transition-all duration-200">
                                        <td class="px-6 py-6">
                                            <div class="flex items-center">
                                                <div class="w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                                    {{ strtoupper(substr($application->full_name, 0, 1)) }}
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-semibold text-gray-900">{{ $application->full_name }}</div>
                                                    <div class="text-sm text-gray-600 mt-1">{{ $application->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-6">
                                            <div class="flex items-center text-sm text-gray-600">
                                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                </svg>
                                                {{ $application->phone_number }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-6">
                                            @if($application->transcript_path)
                                                <a href="{{ asset('storage/' . $application->transcript_path) }}" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl transition-all duration-300 font-medium shadow-lg hover:shadow-xl hover:scale-105 flex items-center space-x-2 w-fit">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                    </svg>
                                                    <span>View Document</span>
                                                </a>
                                            @else
                                                <span class="text-gray-400 italic">No Document</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-6">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border bg-blue-100 text-blue-800 border-blue-200">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                                                </svg>
                                                {{ ucfirst(str_replace('_', ' ', $application->scholarship_type)) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-6">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border bg-yellow-100 text-yellow-800 border-yellow-200">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                                </svg>
                                                {{ ucfirst($application->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-6">
                                            <div class="flex items-center space-x-2">
                                                <form action="{{ route('admin.students.approve', $application->tracking_code) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-xl transition-all duration-300 font-medium shadow-lg hover:shadow-xl hover:scale-105 flex items-center space-x-2">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                        </svg>
                                                        <span>Approve</span>
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.students.reject', $application->tracking_code) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-xl transition-all duration-300 font-medium shadow-lg hover:shadow-xl hover:scale-105 flex items-center space-x-2">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                        </svg>
                                                        <span>Reject</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                            <h3 class="text-lg font-semibold text-gray-900 mb-2">No pending applications found</h3>
                                            <p class="text-gray-600">Applications will appear here when students apply for scholarships</p>
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

        <!-- Students Tab Content -->
        <div id="students-content" class="tab-content hidden">
            <!-- Enhanced Students Table -->
            <div class="glass-card rounded-2xl overflow-hidden shadow-xl">
                <div class="bg-gray-100 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Active Students</h3>
                    <p class="text-sm text-gray-600">Manage active student accounts</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Student</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Contact</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Document</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse($students as $student)
                                <tr class="hover:bg-gray-50 transition-all duration-200">
                                    <td class="px-6 py-6">
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                                {{ strtoupper(substr($student->name, 0, 1)) }}
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-semibold text-gray-900">{{ $student->name }}</div>
                                                <div class="text-sm text-gray-600 mt-1">{{ $student->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6">
                                        @if($student->phone_number)
                                            <div class="flex items-center text-sm text-gray-600">
                                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                </svg>
                                                {{ $student->phone_number }}
                                            </div>
                                        @else
                                            <span class="text-gray-400 italic">No phone number</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-6">
                                        @if($student->scholarship_type)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border bg-blue-100 text-blue-800 border-blue-200">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                                                </svg>
                                                {{ ucfirst(str_replace('_', ' ', $student->scholarship_type)) }}
                                            </span>
                                        @else
                                            <span class="text-gray-400 italic">Not specified</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-6">
                                        @if($student->transcript_path)
                                            <a href="{{ asset('storage/' . $student->transcript_path) }}" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl transition-all duration-300 font-medium shadow-lg hover:shadow-xl hover:scale-105 flex items-center space-x-2 w-fit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                </svg>
                                                <span>View Document</span>
                                            </a>
                                        @else
                                            <span class="text-gray-400 italic">No Document</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-6">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border bg-green-100 text-green-800 border-green-200">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ ucfirst($student->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('users.edit', $student->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl transition-all duration-300 font-medium shadow-lg hover:shadow-xl hover:scale-105 flex items-center space-x-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                <span>Edit</span>
                                            </a>
                                            <form action="{{ route('admin.students.destroyUser', $student->id) }}" method="POST" class="inline-block" onsubmit="return confirm('⚠️ Are you sure you want to delete this student?\n\nThis action cannot be undone and will permanently remove the student account.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-xl transition-all duration-300 font-medium shadow-lg hover:shadow-xl hover:scale-105 flex items-center space-x-2">
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
                                    <td colspan="6" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                                </svg>
                                            </div>
                                            <h3 class="text-lg font-semibold text-gray-900 mb-2">No active students found</h3>
                                            <p class="text-gray-600">Students will appear here after their applications are approved</p>
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
</div>
@endsection

@push('scripts')
<script>
    // Enhanced tab switching functionality
    function showTab(tabName) {
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });

        // Remove active class from all tabs
        document.querySelectorAll('.tab-button').forEach(tab => {
            tab.classList.remove('border-blue-500', 'text-blue-600');
            tab.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
        });

        // Show selected tab content
        document.getElementById(tabName + '-content').classList.remove('hidden');

        // Add active class to selected tab
        const activeTab = document.getElementById(tabName + '-tab');
        activeTab.classList.add('border-blue-500', 'text-blue-600');
        activeTab.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
    }

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

        // Enhanced search functionality
        const searchInput = document.getElementById('student-search-input');
        const searchForm = document.getElementById('student-search-form');

        if (searchInput && searchForm) {
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    searchForm.submit();
                }
            });
        }

        // Auto-submit on filter changes
        document.querySelectorAll('.student-filter-dropdown').forEach(function(dropdown) {
            dropdown.addEventListener('change', function() {
                if (searchForm) searchForm.submit();
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

        // Enhanced confirmation dialogs
        const deleteButtons = document.querySelectorAll('button[onclick*="confirm"]');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const studentName = this.closest('tr').querySelector('td .font-semibold').textContent;
                if (confirm(`⚠️ Delete Student: ${studentName}\n\nThis action cannot be undone and will permanently remove:\n• Student account and profile\n• All associated data\n• Academic records\n\nAre you sure you want to continue?`)) {
                    this.closest('form').submit();
                }
            });
        });

        // Search input focus enhancement
        if (searchInput) {
            searchInput.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
                this.parentElement.style.boxShadow = '0 8px 25px rgba(59, 130, 246, 0.15)';
            });

            searchInput.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
                this.parentElement.style.boxShadow = 'none';
            });
        }

        // Filter dropdown enhancements
        document.querySelectorAll('select').forEach(select => {
            select.addEventListener('focus', function() {
                this.style.transform = 'scale(1.02)';
                this.style.boxShadow = '0 4px 12px rgba(59, 130, 246, 0.15)';
            });

            select.addEventListener('blur', function() {
                this.style.transform = 'scale(1)';
                this.style.boxShadow = 'none';
            });
        });
    });
</script>

<style>
    /* Enhanced table row transitions */
    tbody tr {
        transition: all 0.2s ease-in-out;
    }

    /* Glass effect enhancement */
    .glass-card {
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
    }

    /* Enhanced input and select transitions */
    input, select {
        transition: all 0.3s ease-in-out;
    }

    /* Smooth button hover effects */
    button, a {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
</style>
@endpush
