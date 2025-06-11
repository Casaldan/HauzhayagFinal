@extends('layouts.admin')

@push('styles')
<style>
    /* Professional Dashboard Styles */
    .dashboard-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

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

    .pulse-dot {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    .gradient-text {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hover-lift {
        transition: all 0.3s ease-in-out;
    }

    .hover-lift:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <!-- Enhanced Header -->
    <div class="dashboard-gradient text-white p-6 lg:p-8 mb-8">
        <div class="max-w-7xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="text-sm mb-4 opacity-90">
                <ol class="flex items-center space-x-2">
                    <li><a href="#" class="hover:text-blue-200 transition-colors">Home</a></li>
                    <li><svg class="w-4 h-4 mx-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></li>
                    <li class="text-blue-200">Dashboard</li>
                </ol>
            </nav>

            <!-- Header Content -->
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center space-y-4 lg:space-y-0">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl lg:text-4xl font-bold mb-2">Admin Dashboard</h1>
                        <p class="text-blue-100 text-lg">Welcome back! Here's what's happening today.</p>
                    </div>
                </div>

                <!-- Admin Profile Section -->
                <div class="flex items-center space-x-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm text-blue-100">Logged in as</p>
                        <p class="font-semibold">Administrator</p>
                    </div>
                    <div class="relative">
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                            <span class="text-white font-bold text-lg">AD</span>
                        </div>
                        <div class="absolute -top-1 -right-1 w-4 h-4 bg-green-400 rounded-full pulse-dot"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 lg:px-8 -mt-16 relative z-10">

        <!-- Enhanced Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Users Card -->
            <div class="stat-card glass-card p-6 rounded-2xl fade-in fade-in-delay-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="flex items-center text-blue-500 text-sm font-medium">
                            <div class="w-2 h-2 bg-blue-500 rounded-full mr-2"></div>
                            Active
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $totalUsers ?? '0' }}</h3>
                    <p class="text-gray-600 font-medium">Total Users</p>
                    <p class="text-sm text-gray-500 mt-1">All registered users</p>
                </div>
            </div>

            <!-- Pending Applicants Card -->
            <div class="stat-card glass-card p-6 rounded-2xl fade-in fade-in-delay-2">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-orange-500 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="flex items-center text-amber-500 text-sm font-medium">
                            <div class="w-2 h-2 bg-amber-500 rounded-full mr-2 pulse-dot"></div>
                            Pending
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $pendingApplicants ?? '0' }}</h3>
                    <p class="text-gray-600 font-medium">Pending Applicants</p>
                    <p class="text-sm text-gray-500 mt-1">Awaiting review</p>
                </div>
            </div>

            <!-- Active Students Card -->
            <div class="stat-card glass-card p-6 rounded-2xl fade-in fade-in-delay-3">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="flex items-center text-green-500 text-sm font-medium">
                            <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                            Accepted
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $activeStudents ?? '0' }}</h3>
                    <p class="text-gray-600 font-medium">Active Students</p>
                    <p class="text-sm text-gray-500 mt-1">Currently accepted</p>
                </div>
            </div>

            <!-- Active Events Card -->
            <div class="stat-card glass-card p-6 rounded-2xl fade-in fade-in-delay-4">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="text-right">
                        <div class="flex items-center text-purple-500 text-sm font-medium">
                            <div class="w-2 h-2 bg-purple-500 rounded-full mr-2"></div>
                            Running
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $activeEvents ?? '0' }}</h3>
                    <p class="text-gray-600 font-medium">Active Events</p>
                    <p class="text-sm text-gray-500 mt-1">Ongoing & upcoming</p>
                </div>
            </div>
        </div>

        <!-- Quick Actions Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
            <a href="/events" class="hover-lift glass-card p-4 rounded-xl text-center group">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg mx-auto mb-3 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <p class="font-medium text-gray-900">Manage Events</p>
            </a>

            <a href="/users" class="hover-lift glass-card p-4 rounded-xl text-center group">
                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-lg mx-auto mb-3 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <p class="font-medium text-gray-900">User Management</p>
            </a>

            <a href="/students" class="hover-lift glass-card p-4 rounded-xl text-center group">
                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg mx-auto mb-3 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <p class="font-medium text-gray-900">Applicants</p>
            </a>

            <a href="{{ route('admin.volunteers.index') }}" class="hover-lift glass-card p-4 rounded-xl text-center group">
                <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg mx-auto mb-3 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 515.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <p class="font-medium text-gray-900">Volunteers</p>
            </a>

            <a href="{{ route('admin.jobs.index') }}" class="hover-lift glass-card p-4 rounded-xl text-center group">
                <div class="w-10 h-10 bg-gradient-to-br from-teal-500 to-cyan-600 rounded-lg mx-auto mb-3 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2M8 6v10a2 2 0 002 2h4a2 2 0 002-2V6"/>
                    </svg>
                </div>
                <p class="font-medium text-gray-900">Job Management</p>
            </a>
        </div>

        <!-- Enhanced Events & Activity Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
            <!-- Recent Events -->
            <div class="lg:col-span-2 glass-card rounded-2xl p-8 fade-in" style="animation-delay: 0.5s;">
                <div class="flex justify-between items-center mb-8">
                    <div class="flex items-center space-x-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold gradient-text">Recent Events</h3>
                            <p class="text-gray-600">Latest event activities</p>
                        </div>
                    </div>
                    <a href="{{ route('events.index') }}" class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-6 py-3 rounded-xl hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 font-medium shadow-lg hover:shadow-xl transform hover:scale-105 hover-lift">
                        <span class="flex items-center space-x-2">
                            <span>View All</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </span>
                    </a>
                </div>

                <div class="space-y-4">
                    @forelse($recentEvents ?? [] as $index => $event)
                    <div class="bg-gradient-to-r from-white to-blue-50 border border-blue-100 rounded-2xl p-6 hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02] hover-lift" style="animation-delay: {{ 0.6 + ($index * 0.1) }}s;">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center space-x-3 mb-3">
                                    <div class="w-4 h-4 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full pulse-dot"></div>
                                    <h4 class="font-bold text-gray-900 text-lg">{{ $event->title }}</h4>
                                </div>
                                <div class="flex items-center space-x-6 text-sm text-gray-600 mb-4">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <span class="font-medium">{{ $event->start_date->format('M d, Y') }}</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            </svg>
                                        </div>
                                        <span class="font-medium">{{ $event->location ?? 'TBA' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col items-end space-y-2">
                                <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold shadow-sm {{ $event->status === 'completed' ? 'bg-gradient-to-r from-green-100 to-emerald-100 text-green-800' : ($event->status === 'active' ? 'bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-800' : 'bg-gradient-to-r from-yellow-100 to-amber-100 text-yellow-800') }}">
                                    {{ ucfirst($event->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-16">
                        <div class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-500 mb-3">No Recent Events</h3>
                        <p class="text-gray-400 mb-6">Events will appear here once created</p>
                        <a href="{{ route('events.index') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-xl hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 font-medium shadow-lg hover:shadow-xl transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Create Event
                        </a>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Enhanced Activity Feed -->
            <div class="glass-card rounded-2xl p-8 fade-in" style="animation-delay: 0.6s;">
                <div class="flex items-center space-x-4 mb-8">
                    <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold gradient-text">Live Activity</h3>
                        <p class="text-gray-600">Real-time system updates</p>
                    </div>
                </div>

                <div class="space-y-4">
                    @php
                        // Get recent activities from the system
                        $recentUsers = \App\Models\User::latest()->take(2)->get();
                        $recentEvents = \App\Models\Event::latest()->take(2)->get();
                    @endphp

                    @forelse($recentUsers as $user)
                    <div class="flex items-start space-x-4 p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl border border-green-100 hover-lift">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-bold text-gray-900 mb-1">New {{ ucfirst($user->role) }} registered</p>
                            <p class="text-sm text-gray-600 mb-2">{{ $user->name }} joined as {{ $user->role }}</p>
                            <div class="flex items-center text-xs text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $user->created_at->diffForHumans() }}
                            </div>
                        </div>
                        <div class="w-3 h-3 bg-green-400 rounded-full pulse-dot"></div>
                    </div>
                    @empty
                    @endforelse

                    @forelse($recentEvents as $event)
                    <div class="flex items-start space-x-4 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl border border-blue-100 hover-lift">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-bold text-gray-900 mb-1">New event created</p>
                            <p class="text-sm text-gray-600 mb-2">"{{ $event->title }}" event has been added to the system</p>
                            <div class="flex items-center text-xs text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $event->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                    @empty
                    @endforelse

                    @if($recentUsers->isEmpty() && $recentEvents->isEmpty())
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-500 mb-2">No Recent Activity</h3>
                        <p class="text-gray-400">System activities will appear here</p>
                    </div>
                    @endif
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100">
                    <button class="w-full bg-gradient-to-r from-purple-500 to-pink-600 hover:from-purple-600 hover:to-pink-700 text-white py-3 px-6 rounded-xl transition-all duration-300 font-medium shadow-lg hover:shadow-xl transform hover:scale-105 hover-lift">
                        <span class="flex items-center justify-center space-x-2">
                            <span>View All Activity</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Recent Registrations -->
        <div class="glass-card rounded-2xl p-8 fade-in mb-8" style="animation-delay: 0.7s;">
            <div class="flex items-center space-x-4 mb-6">
                <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Recent Registrations</h3>
                    <p class="text-gray-600">Latest user signups</p>
                </div>
            </div>

            <div class="space-y-3">
                @php
                    $latestUsers = \App\Models\User::latest()->take(5)->get();
                @endphp

                @forelse($latestUsers as $user)
                <div class="flex items-center space-x-3 p-3 bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl hover-lift">
                    <div class="w-10 h-10 bg-gradient-to-br from-{{ $user->role === 'student' ? 'blue' : ($user->role === 'volunteer' ? 'purple' : 'green') }}-500 to-{{ $user->role === 'student' ? 'indigo' : ($user->role === 'volunteer' ? 'pink' : 'emerald') }}-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-gray-900">{{ $user->name }}</p>
                        <p class="text-sm text-gray-600">{{ ucfirst($user->role) }} • {{ $user->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $user->role === 'student' ? 'bg-blue-100 text-blue-800' : ($user->role === 'volunteer' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800') }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <div class="w-16 h-16 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-500 mb-2">No Recent Registrations</h3>
                    <p class="text-gray-400">New user registrations will appear here</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize fade-in animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe all fade-in elements
    document.querySelectorAll('.fade-in').forEach(el => {
        observer.observe(el);
    });

    // Add click animations to interactive elements
    document.querySelectorAll('.hover-lift').forEach(element => {
        element.addEventListener('click', function() {
            this.style.transform = 'scale(0.98)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });

    // Add pulse animation to status indicators
    document.querySelectorAll('.pulse-dot').forEach(dot => {
        setInterval(() => {
            dot.style.transform = 'scale(1.2)';
            setTimeout(() => {
                dot.style.transform = 'scale(1)';
            }, 300);
        }, 2000);
    });

    // Real-time activity updates (optional - can be connected to websockets)
    function refreshActivity() {
        // This can be enhanced to fetch real-time data via AJAX
        console.log('Activity refreshed');
    }

    // Refresh activity every 5 minutes
    setInterval(refreshActivity, 300000);

    // Add smooth scrolling for internal links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add loading states for buttons
    document.querySelectorAll('button, a').forEach(element => {
        element.addEventListener('click', function() {
            if (this.href && !this.href.includes('#')) {
                this.style.opacity = '0.7';
                this.style.pointerEvents = 'none';

                // Reset after 2 seconds if page doesn't change
                setTimeout(() => {
                    this.style.opacity = '';
                    this.style.pointerEvents = '';
                }, 2000);
            }
        });
    });

    // Add keyboard navigation support
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Tab') {
            document.body.classList.add('keyboard-navigation');
        }
    });

    document.addEventListener('mousedown', function() {
        document.body.classList.remove('keyboard-navigation');
    });

    console.log('🎉 Admin Dashboard Enhanced - Professional UI Loaded Successfully!');
});
</script>

<style>
/* Additional responsive and accessibility styles */
.keyboard-navigation *:focus {
    outline: 2px solid #667eea !important;
    outline-offset: 2px !important;
}

@media (max-width: 768px) {
    .stat-card {
        transform: none !important;
    }

    .stat-card:hover {
        transform: translateY(-4px) !important;
    }

    .glass-card {
        backdrop-filter: blur(10px);
    }
}

@media (prefers-reduced-motion: reduce) {
    .fade-in,
    .hover-lift,
    .stat-card,
    .pulse-dot {
        animation: none !important;
        transition: none !important;
    }
}

/* Print styles */
@media print {
    .dashboard-gradient,
    .glass-card {
        background: white !important;
        color: black !important;
    }

    .fade-in {
        opacity: 1 !important;
        transform: none !important;
    }
}
</style>
@endpush
