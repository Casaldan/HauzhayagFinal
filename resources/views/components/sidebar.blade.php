@props(['role' => 'admin', 'currentRoute' => ''])

<!-- Mobile Menu Button -->
<button id="mobile-menu-button" class="lg:hidden fixed top-4 left-4 z-50 bg-[#1B4B5A] text-white p-2 rounded-lg shadow-lg">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
    </svg>
</button>

<!-- Mobile Overlay -->
<div id="mobile-overlay" class="lg:hidden fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>

<!-- Enhanced Professional Sidebar -->
<div id="sidebar" class="w-64 bg-[#1B4B5A] text-white flex flex-col fixed h-full shadow-2xl z-40 transform -translate-x-full lg:translate-x-0 transition-all duration-300 ease-in-out border-r border-[#2C5F6E] overflow-visible">
    <!-- Logo Section -->
    <div class="p-6 lg:p-8 border-b border-[#2C5F6E] bg-[#1B4B5A]">
        <div class="flex items-center space-x-4">
            <div class="relative">
                <img src="{{ asset('image/logohauzhayag.jpg') }}" alt="Hauz Hayag Logo" class="h-12 w-12 lg:h-14 lg:w-14 rounded-xl shadow-lg ring-2 ring-white/20">
                <div class="absolute -top-1 -right-1 w-4 h-4 bg-green-400 rounded-full border-2 border-slate-800"></div>
            </div>
            <div class="flex-1">
                <h1 class="text-xl lg:text-2xl font-bold bg-gradient-to-r from-white to-blue-200 bg-clip-text text-transparent">Hauz</h1>
                <h1 class="text-xl lg:text-2xl font-bold bg-gradient-to-r from-white to-blue-200 bg-clip-text text-transparent -mt-1">Hayag</h1>
                <p class="text-xs text-slate-400 mt-1">
                    @if($role === 'admin')
                        Admin Portal
                    @elseif($role === 'volunteer')
                        Volunteer Portal
                    @elseif($role === 'student')
                        Student Portal
                    @else
                        Portal
                    @endif
                </p>
            </div>
            <!-- Close button for mobile -->
            <button id="mobile-close-button" class="lg:hidden p-2 rounded-lg hover:bg-white/10 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Enhanced Navigation -->
    <nav class="flex-1 flex flex-col px-6 py-8 space-y-2 overflow-y-auto overflow-x-visible">
        @if($role === 'admin')
            <!-- Admin Navigation -->
            <div class="mb-6">
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4">Main Menu</p>

                <!-- Dashboard -->
                <a href="/dashboard" class="group flex items-center py-3 px-4 text-slate-300 hover:text-white hover:bg-white/10 transition-all duration-300 rounded-xl mb-1 {{ str_contains($currentRoute, 'dashboard') || $currentRoute === 'admin.dashboard' ? 'bg-white/20 text-white shadow-lg' : '' }}">
                    <div class="w-10 h-10 rounded-lg bg-slate-700 group-hover:bg-white/20 flex items-center justify-center mr-3 transition-all duration-300 {{ str_contains($currentRoute, 'dashboard') || $currentRoute === 'admin.dashboard' ? 'bg-white/20' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <span class="font-semibold">Dashboard</span>
                        <p class="text-xs text-slate-400 group-hover:text-slate-200">Overview & analytics</p>
                    </div>
                </a>

                <!-- User Management -->
                <a href="/users" class="group flex items-center py-3 px-4 text-slate-300 hover:text-white hover:bg-white/10 transition-all duration-300 rounded-xl mb-1 {{ str_contains($currentRoute, 'users') ? 'bg-white/20 text-white shadow-lg' : '' }}">
                    <div class="w-10 h-10 rounded-lg bg-slate-700 group-hover:bg-white/20 flex items-center justify-center mr-3 transition-all duration-300 {{ str_contains($currentRoute, 'users') ? 'bg-white/20' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <span class="font-semibold">User Management</span>
                        <p class="text-xs text-slate-400 group-hover:text-slate-200">Manage all users</p>
                    </div>
                </a>

                <!-- Events -->
                <a href="/events" class="group flex items-center py-3 px-4 text-slate-300 hover:text-white hover:bg-white/10 transition-all duration-300 rounded-xl mb-1 {{ str_contains($currentRoute, 'events') ? 'bg-white/20 text-white shadow-lg' : '' }}">
                    <div class="w-10 h-10 rounded-lg bg-slate-700 group-hover:bg-white/20 flex items-center justify-center mr-3 transition-all duration-300 {{ str_contains($currentRoute, 'events') ? 'bg-white/20' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <span class="font-semibold">Events</span>
                        <p class="text-xs text-slate-400 group-hover:text-slate-200">Event management</p>
                    </div>
                </a>

                <!-- Applicants -->
                <a href="/students" class="group flex items-center py-3 px-4 text-slate-300 hover:text-white hover:bg-white/10 transition-all duration-300 rounded-xl mb-1 {{ str_contains($currentRoute, 'students') ? 'bg-white/20 text-white shadow-lg' : '' }}">
                    <div class="w-10 h-10 rounded-lg bg-slate-700 group-hover:bg-white/20 flex items-center justify-center mr-3 transition-all duration-300 {{ str_contains($currentRoute, 'students') ? 'bg-white/20' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <span class="font-semibold">Applicants</span>
                        <p class="text-xs text-slate-400 group-hover:text-slate-200">Student applications</p>
                    </div>
                </a>

                <!-- Volunteers -->
                <a href="{{ route('admin.volunteers.index') }}" class="group flex items-center py-3 px-4 text-slate-300 hover:text-white hover:bg-white/10 transition-all duration-300 rounded-xl mb-1 {{ str_contains($currentRoute, 'volunteers') || str_contains($currentRoute, 'volunteer-applications') ? 'bg-white/20 text-white shadow-lg' : '' }}">
                    <div class="w-10 h-10 rounded-lg bg-slate-700 group-hover:bg-white/20 flex items-center justify-center mr-3 transition-all duration-300 {{ str_contains($currentRoute, 'volunteers') || str_contains($currentRoute, 'volunteer-applications') ? 'bg-white/20' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 515.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <span class="font-semibold">Volunteers</span>
                        <p class="text-xs text-slate-400 group-hover:text-slate-200">Volunteer management</p>
                    </div>
                </a>

                <!-- Jobs -->
                <a href="{{ route('admin.jobs.index') }}" class="group flex items-center py-3 px-4 text-slate-300 hover:text-white hover:bg-white/10 transition-all duration-300 rounded-xl mb-1 {{ str_contains($currentRoute, 'jobs') ? 'bg-white/20 text-white shadow-lg' : '' }}">
                    <div class="w-10 h-10 rounded-lg bg-slate-700 group-hover:bg-white/20 flex items-center justify-center mr-3 transition-all duration-300 {{ str_contains($currentRoute, 'jobs') ? 'bg-white/20' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2M8 6v10a2 2 0 002 2h4a2 2 0 002-2V6"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <span class="font-semibold">Jobs</span>
                        <p class="text-xs text-slate-400 group-hover:text-slate-200">Job postings</p>
                    </div>
                </a>
            </div>
            
        @elseif($role === 'volunteer')
            <!-- Volunteer Navigation -->
            <a href="{{ route('volunteer.dashboard') }}" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition-all duration-300 ease-in-out hover:bg-white/10 {{ str_contains($currentRoute, 'volunteer.dashboard') ? 'bg-white/20 shadow-md' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="text-base font-medium">Dashboard</span>
            </a>

            <a href="{{ route('volunteer.events') }}" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition-all duration-300 ease-in-out hover:bg-white/10 {{ str_contains($currentRoute, 'volunteer.events') ? 'bg-white/20 shadow-md' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span class="text-base font-medium">Events</span>
            </a>

            <a href="{{ route('volunteer.jobs') }}" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition-all duration-300 ease-in-out hover:bg-white/10 {{ str_contains($currentRoute, 'jobs') ? 'bg-white/20 shadow-md' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2M8 6v10a2 2 0 002 2h4a2 2 0 002-2V6"/>
                </svg>
                <span class="text-base font-medium">Job Listings</span>
            </a>
            
        @elseif($role === 'student')
            <!-- User Indicator -->
            <div class="mb-6 px-4 relative">
                <div class="flex flex-col items-center">
                    <!-- Clickable Profile Area -->
                    <div class="relative mb-4 cursor-pointer" onclick="toggleProfileDropdown()">
                        <!-- Profile Picture or Silhouette -->
                        @if(Auth::user()->profile_picture)
                            <img src="{{ Storage::url(Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}" class="w-20 h-20 rounded-full object-cover shadow-xl hover:shadow-2xl transition-shadow duration-200">
                        @else
                            <div class="w-20 h-20 bg-gray-300 rounded-full flex items-center justify-center overflow-hidden shadow-xl hover:shadow-2xl transition-shadow duration-200">
                                <!-- Generic Profile Silhouette -->
                                <svg class="w-12 h-12 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                            </div>
                        @endif

                        <!-- Camera Icon for Upload -->
                        <button onclick="event.stopPropagation(); document.getElementById('profile-picture-input').click()" class="absolute -bottom-1 -right-1 w-8 h-8 bg-blue-500 hover:bg-blue-600 rounded-full flex items-center justify-center text-white transition-all duration-200 shadow-xl hover:scale-110">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </button>

                        <!-- Hidden File Input -->
                        <form id="profile-picture-form" action="{{ route('student.profile.picture.upload') }}" method="POST" enctype="multipart/form-data" class="hidden">
                            @csrf
                            <input type="file" id="profile-picture-input" name="profile_picture" accept="image/*" onchange="uploadProfilePicture()" class="hidden">
                        </form>
                    </div>

                    <!-- Clickable Name -->
                    <p class="text-white font-medium text-sm text-center cursor-pointer hover:text-blue-200 transition-colors duration-200" onclick="toggleProfileDropdown()">{{ Auth::user()->name }}</p>
                </div>

                <!-- View Profile Button -->
                <div class="mt-2 text-center">
                    <button onclick="toggleProfileModal()" class="text-xs text-slate-400 hover:text-white transition-colors duration-200 underline">
                        VIEW PROFILE
                    </button>
                </div>

                <!-- Profile Dropdown -->
                <div id="profile-dropdown" class="fixed bg-white rounded-xl shadow-2xl border-2 border-black z-[9999] hidden min-w-[420px] max-h-[500px] overflow-visible" style="left: 272px; top: 50%;">
                    <div class="p-8">
                        <!-- User Info Header -->
                        <div class="flex items-center mb-7 pb-6 border-b border-gray-100">
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mr-6">
                                <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-800 text-xl">{{ Auth::user()->name }}</h4>
                                <p class="text-base text-gray-500 mt-2">Student Profile</p>
                            </div>
                        </div>

                        <!-- Profile Actions Section -->
                        <div class="space-y-4">
                            <!-- Profile management actions can be added here if needed -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Spacer for lower positioning -->
            <div class="mb-12"></div>

            <!-- Student Navigation -->
            <a href="{{ route('student.dashboard') }}" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition-all duration-300 ease-in-out hover:bg-white/10 {{ str_contains($currentRoute, 'student.dashboard') ? 'bg-white/20 shadow-md' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="text-base font-medium">Dashboard</span>
            </a>

            <a href="{{ route('student.events.index') }}" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition-all duration-300 ease-in-out hover:bg-white/10 {{ str_contains($currentRoute, 'student.events') ? 'bg-white/20 shadow-md' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span class="text-base font-medium">Events</span>
            </a>

            <a href="{{ route('student.jobs.index') }}" class="sidebar-link flex items-center py-3 px-4 rounded-lg transition-all duration-300 ease-in-out hover:bg-white/10 {{ str_contains($currentRoute, 'jobs') ? 'bg-white/20 shadow-md' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2M8 6v10a2 2 0 002 2h4a2 2 0 002-2V6"/>
                </svg>
                <span class="text-base font-medium">Job Listings</span>
            </a>
        @endif
    </nav>
    
    <!-- Enhanced Logout Section -->
    <div class="mt-auto px-6 py-6 border-t border-[#2C5F6E] bg-[#1B4B5A]">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="group w-full flex items-center py-3 px-4 text-slate-300 hover:text-white hover:bg-white/10 transition-all duration-300 rounded-xl">
                <div class="w-10 h-10 rounded-lg bg-slate-700 group-hover:bg-white/20 flex items-center justify-center mr-3 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </div>
                <div class="flex-1 text-left">
                    <span class="font-semibold">Logout</span>
                    <p class="text-xs text-slate-400 group-hover:text-slate-200">Sign out securely</p>
                </div>
            </button>
        </form>


    </div>
</div>

<!-- Profile Modal (Outside sidebar for proper z-index) -->
@if(Auth::check() && Auth::user()->role === 'student')
<div id="profile-modal" class="fixed inset-0 bg-black bg-opacity-50 z-[9999] hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[95vh] flex flex-col">
        <!-- Modal Header -->
        <div class="relative bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-6 text-white flex-shrink-0">
            <button onclick="toggleProfileModal()" class="absolute top-4 right-4 text-white/80 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Profile Header -->
            <div class="flex items-center">
                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mr-4 backdrop-blur-sm">
                    @if(Auth::user()->profile_picture)
                        <img src="{{ Storage::url(Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}" class="w-16 h-16 rounded-full object-cover">
                    @else
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    @endif
                </div>
                <div>
                    <h2 class="text-xl font-bold">{{ Auth::user()->name }}</h2>
                    <p class="text-blue-100 text-sm">Student Profile</p>
                    <p class="text-blue-200 text-xs mt-1">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>

        <!-- Modal Content -->
        <div class="flex-1 overflow-y-auto p-8">
            <!-- Profile Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Full Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <div class="p-3 bg-gray-50 border border-gray-200 rounded-lg">
                        <p class="text-gray-800">{{ Auth::user()->name }}</p>
                    </div>
                </div>

                <!-- Email Address -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <div class="p-3 bg-gray-50 border border-gray-200 rounded-lg">
                        <p class="text-gray-800">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Password Management Section -->
            <div class="border-t border-gray-200 pt-8">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Password Settings</h3>
                    <p class="text-sm text-gray-600">Update your account password for security. Your temporary password was sent to your Gmail address.</p>
                </div>

                <button onclick="togglePasswordChangeForm()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition-colors duration-200 font-medium">
                    Change Password
                </button>
            </div>

            <!-- Password Change Form -->
            <div id="password-change-form" class="hidden mt-8 bg-gray-50 rounded-lg p-8 border border-gray-200">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800">Change Your Password</h3>
                        <p class="text-sm text-gray-600 mt-1">Enter your current password and choose a new secure password</p>
                    </div>
                    <button type="button" onclick="togglePasswordChangeForm()" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Success/Error Messages -->
                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-800 rounded-lg text-sm flex items-center">
                        <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-800 rounded-lg text-sm flex items-center">
                        <svg class="w-4 h-4 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-800 rounded-lg text-sm">
                        <div class="flex items-start">
                            <svg class="w-4 h-4 mr-2 text-red-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <ul class="list-disc list-inside text-xs space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form action="{{ route('student.profile.password.change') }}" method="POST" class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
                    @csrf

                    <div class="grid grid-cols-1 gap-6">
                        <!-- Current Password -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Current Password *</label>
                            <input type="password" name="current_password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required placeholder="Enter your current password">
                            <p class="text-sm text-blue-600 mt-2">💡 Use the temporary password sent to your Gmail: <strong>{{ Auth::user()->email }}</strong></p>
                        </div>

                        <!-- New Password -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">New Password *</label>
                            <input type="password" name="new_password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required placeholder="Enter your new password" minlength="8">
                            <p class="text-sm text-gray-500 mt-2">Password must be at least 8 characters long</p>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Confirm New Password *</label>
                            <input type="password" name="new_password_confirmation" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required placeholder="Confirm your new password">
                            <p class="text-sm text-gray-500 mt-2">Re-enter your new password to confirm</p>
                        </div>
                    </div>

                    <!-- Form Buttons -->
                    <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                        <button type="button" onclick="togglePasswordChangeForm()" class="px-6 py-3 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 font-medium">
                            Cancel
                        </button>
                        <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200 font-medium">
                            Update Password
                        </button>
                    </div>
                </form>
            </div>

            <!-- Bottom Padding -->
            <div class="h-6"></div>
        </div>
    </div>
</div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileCloseButton = document.getElementById('mobile-close-button');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('mobile-overlay');

    function openSidebar() {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeSidebar() {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    if (mobileMenuButton) {
        mobileMenuButton.addEventListener('click', openSidebar);
    }

    if (mobileCloseButton) {
        mobileCloseButton.addEventListener('click', closeSidebar);
    }

    if (overlay) {
        overlay.addEventListener('click', closeSidebar);
    }

    // Close sidebar when clicking on navigation links on mobile
    const navLinks = sidebar.querySelectorAll('a');
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth < 1024) {
                closeSidebar();
            }
        });
    });

    // Handle window resize
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            closeSidebar();
        }
    });

    // Profile picture upload function
    window.uploadProfilePicture = function() {
        const form = document.getElementById('profile-picture-form');
        const input = document.getElementById('profile-picture-input');

        if (input.files && input.files[0]) {
            // Show loading state
            const button = document.querySelector('.absolute.-bottom-1.-right-1');
            if (button) {
                button.innerHTML = '<div class="w-3 h-3 border-2 border-white border-t-transparent rounded-full animate-spin"></div>';
            }

            // Submit form
            form.submit();
        }
    };

    // Profile dropdown toggle function
    window.toggleProfileDropdown = function() {
        const dropdown = document.getElementById('profile-dropdown');
        const profileArea = document.querySelector('[onclick="toggleProfileDropdown()"]');

        if (dropdown && profileArea) {
            if (dropdown.classList.contains('hidden')) {
                // Position dropdown to the right of the profile
                const rect = profileArea.getBoundingClientRect();
                const sidebarWidth = 256; // w-64 = 256px

                // Position to the right of the sidebar
                dropdown.style.left = sidebarWidth + 16 + 'px'; // sidebar width + margin
                dropdown.style.top = rect.top + 'px';

                dropdown.classList.remove('hidden');
            } else {
                dropdown.classList.add('hidden');
            }
        }
    };

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('profile-dropdown');
        const profileArea = event.target.closest('[onclick="toggleProfileDropdown()"]');

        if (dropdown && !profileArea && !dropdown.contains(event.target)) {
            dropdown.classList.add('hidden');
        }

        // Close profile modal when clicking outside
        const profileModal = document.getElementById('profile-modal');
        const profileModalArea = event.target.closest('[onclick="toggleProfileModal()"]');
        const modalContent = profileModal?.querySelector('.bg-white');

        if (profileModal && !profileModalArea && !modalContent?.contains(event.target)) {
            profileModal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    });

    // Profile Modal toggle function
    window.toggleProfileModal = function() {
        const modal = document.getElementById('profile-modal');
        if (modal) {
            modal.classList.toggle('hidden');
            if (!modal.classList.contains('hidden')) {
                document.body.classList.add('overflow-hidden');
            } else {
                document.body.classList.remove('overflow-hidden');
            }
        }
    };

    // Toggle password change form
    window.togglePasswordChangeForm = function() {
        const form = document.getElementById('password-change-form');
        if (form) {
            form.classList.toggle('hidden');
        }
    };

    // Toggle password visibility
    window.togglePasswordVisibility = function(inputId, button) {
        const input = document.getElementById(inputId);
        if (input) {
            if (input.type === 'password') {
                input.type = 'text';
                button.innerHTML = `
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
                    </svg>
                `;
            } else {
                input.type = 'password';
                button.innerHTML = `
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                `;
            }
        }
    };
});
</script>


