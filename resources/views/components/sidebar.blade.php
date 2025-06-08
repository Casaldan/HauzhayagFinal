@props(['role' => 'admin', 'currentRoute' => ''])

<div class="w-64 bg-[#1B4B5A] text-white flex flex-col fixed h-full shadow-lg">
    <div class="p-4 flex items-center space-x-3 border-b border-[#2C5F6E]">
        <img src="{{ asset('image/logohauzhayag.jpg') }}" alt="Hauz Hayag Logo" class="h-16 w-auto rounded-lg shadow-md">
        <h1 class="text-2xl font-bold">Hauz Hayag</h1>
    </div>
    
    <nav class="flex-1 flex flex-col px-4 py-6 space-y-2">
        @if($role === 'admin')
            <!-- Admin Navigation -->
            <a href="/dashboard" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition-all duration-300 ease-in-out hover:bg-[#2C5F6E] hover:shadow-md transform hover:scale-105 {{ $currentRoute === 'dashboard' ? 'bg-[#2C5F6E] shadow-md' : '' }}">
                <svg class="w-6 h-6 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="text-lg font-medium">Dashboard</span>
            </a>
            
            <a href="/users" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition-all duration-300 ease-in-out hover:bg-[#2C5F6E] hover:shadow-md transform hover:scale-105 {{ $currentRoute === 'users' ? 'bg-[#2C5F6E] shadow-md' : '' }}">
                <svg class="w-6 h-6 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <span class="text-lg font-medium">User Management</span>
            </a>
            
            <a href="/events" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition-all duration-300 ease-in-out hover:bg-[#2C5F6E] hover:shadow-md transform hover:scale-105 {{ $currentRoute === 'events' ? 'bg-[#2C5F6E] shadow-md' : '' }}">
                <svg class="w-6 h-6 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span class="text-lg font-medium">Events</span>
            </a>
            
            <a href="/students" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition-all duration-300 ease-in-out hover:bg-[#2C5F6E] hover:shadow-md transform hover:scale-105 {{ $currentRoute === 'students' ? 'bg-[#2C5F6E] shadow-md' : '' }}">
                <svg class="w-6 h-6 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                <span class="text-lg font-medium">Applicants</span>
            </a>
            
            <a href="{{ route('admin.volunteers.index') }}" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition-all duration-300 ease-in-out hover:bg-[#2C5F6E] hover:shadow-md transform hover:scale-105 {{ $currentRoute === 'volunteers' ? 'bg-[#2C5F6E] shadow-md' : '' }}">
                <svg class="w-6 h-6 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <span class="text-lg font-medium">Volunteers</span>
            </a>
            
            <a href="/admin/volunteer-applications" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition-all duration-300 ease-in-out hover:bg-[#2C5F6E] hover:shadow-md transform hover:scale-105 {{ $currentRoute === 'volunteer-applications' ? 'bg-[#2C5F6E] shadow-md' : '' }}">
                <svg class="w-6 h-6 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <span class="text-lg font-medium">Event Applications</span>
            </a>
            
            <a href="/admin/jobs" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition-all duration-300 ease-in-out hover:bg-[#2C5F6E] hover:shadow-md transform hover:scale-105 {{ $currentRoute === 'jobs' ? 'bg-[#2C5F6E] shadow-md' : '' }}">
                <svg class="w-6 h-6 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2M8 6v10a2 2 0 002 2h4a2 2 0 002-2V6"/>
                </svg>
                <span class="text-lg font-medium">Jobs</span>
            </a>
            
        @elseif($role === 'volunteer')
            <!-- Volunteer Navigation -->
            <a href="{{ route('volunteer.dashboard') }}" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition-all duration-300 ease-in-out hover:bg-[#2C5F6E] hover:shadow-md transform hover:scale-105 {{ $currentRoute === 'dashboard' ? 'bg-[#2C5F6E] shadow-md' : '' }}">
                <svg class="w-6 h-6 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="text-lg font-medium">Dashboard</span>
            </a>
            
            <a href="{{ route('volunteer.events') }}" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition-all duration-300 ease-in-out hover:bg-[#2C5F6E] hover:shadow-md transform hover:scale-105 {{ $currentRoute === 'events' ? 'bg-[#2C5F6E] shadow-md' : '' }}">
                <svg class="w-6 h-6 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span class="text-lg font-medium">Events</span>
            </a>
            
            <a href="{{ route('volunteer.jobs.listings') }}" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition-all duration-300 ease-in-out hover:bg-[#2C5F6E] hover:shadow-md transform hover:scale-105 {{ $currentRoute === 'jobs' ? 'bg-[#2C5F6E] shadow-md' : '' }}">
                <svg class="w-6 h-6 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2M8 6v10a2 2 0 002 2h4a2 2 0 002-2V6"/>
                </svg>
                <span class="text-lg font-medium">Job Listings</span>
            </a>
            
        @elseif($role === 'student')
            <!-- Student Navigation -->
            <a href="{{ route('student.dashboard') }}" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition-all duration-300 ease-in-out hover:bg-[#2C5F6E] hover:shadow-md transform hover:scale-105 {{ $currentRoute === 'dashboard' ? 'bg-[#2C5F6E] shadow-md' : '' }}">
                <svg class="w-6 h-6 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="text-lg font-medium">Dashboard</span>
            </a>
            
            <a href="{{ route('student.events.index') }}" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition-all duration-300 ease-in-out hover:bg-[#2C5F6E] hover:shadow-md transform hover:scale-105 {{ $currentRoute === 'events' ? 'bg-[#2C5F6E] shadow-md' : '' }}">
                <svg class="w-6 h-6 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span class="text-lg font-medium">Events</span>
            </a>
            
            <a href="{{ route('student.scholarship') }}" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition-all duration-300 ease-in-out hover:bg-[#2C5F6E] hover:shadow-md transform hover:scale-105 {{ $currentRoute === 'scholarship' ? 'bg-[#2C5F6E] shadow-md' : '' }}">
                <svg class="w-6 h-6 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                <span class="text-lg font-medium">Scholarship</span>
            </a>
        @endif
    </nav>
    
    <!-- Logout Section -->
    <div class="mt-auto p-4 border-t border-[#2C5F6E]">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center py-3 px-4 rounded-lg transition-all duration-300 ease-in-out hover:bg-red-600 hover:shadow-md transform hover:scale-105 text-red-300 hover:text-white">
                <svg class="w-6 h-6 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                <span class="text-lg font-medium">Logout</span>
            </button>
        </form>
    </div>
</div>
