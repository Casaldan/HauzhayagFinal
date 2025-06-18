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
<div id="sidebar" class="w-64 bg-[#1B4B5A] text-white flex flex-col fixed h-full shadow-2xl z-40 transform -translate-x-full lg:translate-x-0 transition-all duration-300 ease-in-out border-r border-[#2C5F6E]">
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
    <nav class="flex-1 flex flex-col px-6 py-8 space-y-2 overflow-y-auto">
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
});
</script>


