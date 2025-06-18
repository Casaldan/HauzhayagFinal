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

    .primary-text {
        color: #007cba;
    }

    .dashboard-primary {
        background: #007cba;
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Enhanced Header -->
    <div class="dashboard-primary text-white p-6 lg:p-8 mb-8">
        <div class="max-w-7xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="text-sm mb-4 opacity-90">
                <ol class="flex items-center space-x-2">
                    <li><a href="{{ route('admin.dashboard') }}" class="hover:text-blue-200 transition-colors">Dashboard</a></li>
                    <li><svg class="w-4 h-4 mx-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></li>
                    <li class="text-blue-200">Volunteer Management</li>
                </ol>
            </nav>

            <!-- Header Content -->
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center space-y-4 lg:space-y-0">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl lg:text-4xl font-bold mb-2">Volunteer Management</h1>
                        <p class="text-blue-100 text-lg">Manage and review volunteer accounts</p>
                    </div>
                </div>

                <!-- Add Volunteer Button -->
                <a href="{{ route('users.create', ['role' => 'volunteer']) }}" class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-6 py-3 rounded-xl transition-all duration-300 font-medium backdrop-blur-sm border border-white border-opacity-20 hover:scale-105 flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Add Volunteer</span>
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 lg:px-8 -mt-16 relative z-10">

        <!-- Enhanced Tab Navigation -->
        <div class="glass-card rounded-2xl mb-8 overflow-hidden">
            <nav class="flex bg-gray-50" aria-label="Tabs">
                <button onclick="showTab('volunteers')" id="volunteers-tab" class="tab-button flex-1 border-b-4 border-blue-500 text-blue-600 py-4 px-6 text-sm font-semibold transition-all duration-300 ease-in-out flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    <span>All Volunteers</span>
                </button>
                <button onclick="showTab('event-applications')" id="event-applications-tab" class="tab-button flex-1 border-b-4 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 py-4 px-6 text-sm font-semibold transition-all duration-300 ease-in-out flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <span>Event Applications</span>
                </button>
            </nav>
        </div>

        <!-- Tab Content -->
        <div id="volunteers-content" class="tab-content">
            <!-- Enhanced Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Volunteers -->
                <div class="glass-card stat-card fade-in fade-in-delay-1 rounded-2xl p-6 hover-lift">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Total Volunteers</p>
                            <p class="text-3xl font-bold primary-text">{{ $totalVolunteersCount ?? $volunteers->total() }}</p>
                            <p class="text-xs text-gray-500 mt-1">All volunteers</p>
                        </div>
                        <div class="w-14 h-14 bg-primary rounded-2xl flex items-center justify-center shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Active Volunteers -->
                <div class="glass-card stat-card fade-in fade-in-delay-2 rounded-2xl p-6 hover-lift">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Active Volunteers</p>
                            <p class="text-3xl font-bold text-green-600">{{ $activeVolunteersCount ?? $volunteers->where('status', 'active')->count() }}</p>
                            <p class="text-xs text-gray-500 mt-1">Currently active</p>
                        </div>
                        <div class="w-14 h-14 bg-green-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Inactive Volunteers -->
                <div class="glass-card stat-card fade-in fade-in-delay-3 rounded-2xl p-6 hover-lift">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Inactive Volunteers</p>
                            <p class="text-3xl font-bold text-red-600">{{ $inactiveVolunteersCount ?? $volunteers->where('status', 'inactive')->count() }}</p>
                            <p class="text-xs text-gray-500 mt-1">Not active</p>
                        </div>
                        <div class="w-14 h-14 bg-red-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Pending Volunteers -->
                <div class="glass-card stat-card fade-in fade-in-delay-4 rounded-2xl p-6 hover-lift">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-1">Pending Volunteers</p>
                            <p class="text-3xl font-bold text-yellow-600">{{ $totalPendingCount ?? ($pendingVolunteersCount + $pendingEventApplicationsCount) ?? $volunteers->where('status', 'pending')->count() }}</p>
                            <p class="text-xs text-gray-500 mt-1">Awaiting approval</p>
                        </div>
                        <div class="w-14 h-14 bg-yellow-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Search and Filter Tools -->
            <div class="glass-card rounded-2xl p-6 mb-8">
                <form id="volunteer-search-form" method="GET" class="flex flex-col lg:flex-row gap-4">
                    <input type="hidden" name="role" value="volunteer">

                    <!-- Search Input -->
                    <div class="relative flex-grow">
                        <input
                            type="text"
                            name="search"
                            id="volunteer-search-input"
                            placeholder="Search volunteers by name or email..."
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
                        <select name="status" class="appearance-none pl-4 pr-10 py-3 border border-gray-200 bg-white rounded-xl text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm volunteer-filter-dropdown shadow-sm transition-all duration-300 min-w-[140px]">
                            <option value="">All Statuses</option>
                            <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Inactive" {{ request('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-400">
                            <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Clear Filters Button -->
                    @if(request()->hasAny(['search', 'status']))
                        <a href="{{ route('admin.volunteers.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-3 rounded-xl transition-all duration-300 font-medium flex items-center space-x-2 min-w-fit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            <span>Clear</span>
                        </a>
                    @endif
                </form>
            </div>

            <!-- Enhanced Volunteers Table -->
            <div class="glass-card rounded-2xl overflow-hidden shadow-xl">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Volunteer Directory</h3>
                    <p class="text-sm text-gray-600">Manage all volunteer accounts and permissions</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Volunteer</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Phone Number</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse($volunteers as $volunteer)
                                <tr class="hover:bg-gray-50 transition-all duration-200">
                                    <td class="px-6 py-6">
                                        <div class="flex items-center">
                                            @if($volunteer->profile_picture)
                                                <img src="{{ Storage::url($volunteer->profile_picture) }}" alt="{{ $volunteer->name }}" class="w-12 h-12 rounded-full object-cover shadow-lg border-2 border-white">
                                            @else
                                                <div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                                    {{ strtoupper(substr($volunteer->name, 0, 1)) }}
                                                </div>
                                            @endif
                                            <div class="ml-4">
                                                <div class="text-sm font-semibold text-gray-900">{{ $volunteer->name }}</div>
                                                <div class="text-sm text-gray-600 mt-1">{{ $volunteer->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border
                                            @if($volunteer->status == 'Active') bg-green-100 text-green-800 border-green-200
                                            @elseif($volunteer->status == 'Inactive') bg-red-100 text-red-800 border-red-200
                                            @else bg-yellow-100 text-yellow-800 border-yellow-200
                                            @endif">
                                            @if($volunteer->status == 'Active')
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                </svg>
                                            @elseif($volunteer->status == 'Inactive')
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                                </svg>
                                            @else
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                                </svg>
                                            @endif
                                            {{ $volunteer->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-6 text-sm text-gray-600">
                                        @if($volunteer->phone)
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                </svg>
                                                {{ $volunteer->phone }}
                                            </div>
                                        @else
                                            <span class="text-gray-400 italic">No phone number</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="flex items-center space-x-2">
                                            @if($volunteer->status == 'Pending')
                                                <form action="{{ route('admin.volunteers.approve', $volunteer) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-xl transition-all duration-300 font-medium shadow-lg hover:shadow-xl hover:scale-105 flex items-center space-x-2">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                        </svg>
                                                        <span>Approve</span>
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.volunteers.reject', $volunteer) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-xl transition-all duration-300 font-medium shadow-lg hover:shadow-xl hover:scale-105 flex items-center space-x-2">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                        </svg>
                                                        <span>Reject</span>
                                                    </button>
                                                </form>
                                            @else
                                                <a href="{{ route('admin.volunteers.edit', $volunteer) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl transition-all duration-300 font-medium shadow-lg hover:shadow-xl hover:scale-105 flex items-center space-x-2">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                    <span>Edit</span>
                                                </a>
                                                <form action="{{ route('admin.volunteers.destroy', $volunteer) }}" method="POST" class="inline-block" onsubmit="return confirm('⚠️ Are you sure you want to delete {{ $volunteer->name }}?\n\nThis action cannot be undone and will permanently remove the volunteer account.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-xl transition-all duration-300 font-medium shadow-lg hover:shadow-xl hover:scale-105 flex items-center space-x-2">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                        <span>Delete</span>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                                </svg>
                                            </div>
                                            <h3 class="text-lg font-semibold text-gray-900 mb-2">No volunteers found</h3>
                                            <p class="text-gray-600 mb-6">No volunteers match your current search criteria.</p>
                                            <a href="{{ route('users.create', ['role' => 'volunteer']) }}" class="bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white px-6 py-3 rounded-xl transition-all duration-300 font-medium shadow-lg hover:shadow-xl hover:scale-105 flex items-center space-x-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                </svg>
                                                <span>Add First Volunteer</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Enhanced Pagination -->
                @if($volunteers->hasPages())
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                        {{ $volunteers->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Event Applications Tab Content -->
    <div id="event-applications-content" class="tab-content hidden bg-white rounded-b-lg shadow">
        <div class="p-6">
            <!-- Page Header -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Volunteer Event Applications</h1>
                <p class="text-gray-600">Manage volunteer applications for events</p>
            </div>

            <!-- Event Applications Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applicant</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Application Reason</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applied Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="event-applications-tbody">
                            <!-- Content will be loaded via AJAX -->
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="text-gray-500">
                                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                        <p class="text-lg font-medium">Loading event applications...</p>
                                    </div>
                                </td>
                            </tr>
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
    // Tab switching functionality
    function showTab(tabName) {
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });

        // Remove active class from all tabs
        document.querySelectorAll('.tab-button').forEach(tab => {
            tab.classList.remove('border-primary', 'text-primary');
            tab.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
        });

        // Show selected tab content
        document.getElementById(tabName + '-content').classList.remove('hidden');

        // Add active class to selected tab
        const activeTab = document.getElementById(tabName + '-tab');
        activeTab.classList.add('border-primary', 'text-primary');
        activeTab.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');

        // Load event applications if that tab is selected
        if (tabName === 'event-applications') {
            loadEventApplications();
        }
    }

    // Load event applications via AJAX
    function loadEventApplications() {
        const tbody = document.getElementById('event-applications-tbody');

        fetch('/admin/volunteers/event-applications')
            .then(response => response.json())
            .then(applications => {
                tbody.innerHTML = '';

                if (applications.length === 0) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="text-gray-500">
                                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                    <p class="text-lg font-medium">No event applications yet</p>
                                    <p class="text-sm">Applications will appear here when volunteers register for events</p>
                                </div>
                            </td>
                        </tr>
                    `;
                } else {
                    applications.forEach(application => {
                        const statusClass = application.status === 'approved' ? 'bg-green-100 text-green-800' :
                                          application.status === 'rejected' ? 'bg-red-100 text-red-800' :
                                          'bg-yellow-100 text-yellow-800';

                        const row = document.createElement('tr');
                        row.className = 'hover:bg-gray-50 transition-colors duration-200';
                        row.innerHTML = `
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">${application.full_name}</div>
                                    <div class="text-sm text-gray-500">${application.email}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">${application.event.title}</div>
                                <div class="text-sm text-gray-500">${application.event.location || 'Location TBD'}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">${application.application_reason.substring(0, 100)}${application.application_reason.length > 100 ? '...' : ''}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${statusClass}">
                                    ${application.status.charAt(0).toUpperCase() + application.status.slice(1)}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                ${new Date(application.applied_at || application.created_at).toLocaleDateString()}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                ${application.status === 'pending' ? `
                                    <button onclick="updateApplicationStatus(${application.id}, 'approved')"
                                            class="bg-green-600 text-white px-3 py-1 rounded-lg hover:bg-green-700 transition-colors">
                                        Approve
                                    </button>
                                    <button onclick="updateApplicationStatus(${application.id}, 'rejected')"
                                            class="bg-red-600 text-white px-3 py-1 rounded-lg hover:bg-red-700 transition-colors">
                                        Reject
                                    </button>
                                ` : ''}
                                <button onclick="viewApplicationDetails(${application.id})"
                                        class="bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700 transition-colors">
                                    View
                                </button>
                            </td>
                        `;
                        tbody.appendChild(row);
                    });
                }
            })
            .catch(error => {
                console.error('Error loading event applications:', error);
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="text-red-500">
                                <p class="text-lg font-medium">Error loading applications</p>
                                <p class="text-sm">Please refresh the page and try again</p>
                            </div>
                        </td>
                    </tr>
                `;
            });
    }



    // Update application status
    function updateApplicationStatus(applicationId, status) {
        if (!confirm(`Are you sure you want to ${status} this application?`)) {
            return;
        }

        fetch(`/admin/volunteer-applications/${applicationId}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                status: status,
                admin_notes: ''
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.message) {
                alert(data.message);
                // Reload the event applications tab
                loadEventApplications();
                // Reload the page to update volunteer counts
                window.location.reload();
            }
        })
        .catch(error => {
            console.error('Error updating application status:', error);
            alert('Error updating application status. Please try again.');
        });
    }

    // View application details
    function viewApplicationDetails(applicationId) {
        fetch(`/admin/volunteer-applications/${applicationId}`)
            .then(response => response.json())
            .then(application => {
                alert(`Application Details:\n\nName: ${application.full_name}\nEmail: ${application.email}\nPhone: ${application.phone_number}\nEvent: ${application.event.title}\nReason: ${application.application_reason}\nStatus: ${application.status}\nApplied: ${new Date(application.applied_at || application.created_at).toLocaleDateString()}`);
            })
            .catch(error => {
                console.error('Error loading application details:', error);
                alert('Error loading application details. Please try again.');
            });
    }

    // Search form functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Add CSRF token meta tag if not present
        if (!document.querySelector('meta[name="csrf-token"]')) {
            const meta = document.createElement('meta');
            meta.name = 'csrf-token';
            meta.content = '{{ csrf_token() }}';
            document.getElementsByTagName('head')[0].appendChild(meta);
        }

        // Initialize fade-in animations
        const fadeElements = document.querySelectorAll('.fade-in');
        fadeElements.forEach((element, index) => {
            setTimeout(() => {
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }, index * 100);
        });

        // Enhanced search functionality
        const searchInput = document.getElementById('volunteer-search-input');
        const searchForm = document.getElementById('volunteer-search-form');

        if (searchInput && searchForm) {
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    searchForm.submit();
                }
            });
        }

        // Auto-submit on filter changes
        document.querySelectorAll('.volunteer-filter-dropdown').forEach(function(dropdown) {
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
                const volunteerName = this.closest('tr').querySelector('td .font-semibold').textContent;
                if (confirm(`⚠️ Delete Volunteer: ${volunteerName}\n\nThis action cannot be undone and will permanently remove:\n• Volunteer account and profile\n• All associated data\n• Event applications\n\nAre you sure you want to continue?`)) {
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
