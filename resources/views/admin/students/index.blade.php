<x-app-layout>
    <!-- Add Tailwind CSS to ensure all styles work properly -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1B4B5A',
                        secondary: '#2C5F6E',
                        accent: '#00A4B8',
                    }
                }
            }
        }
    </script>

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="w-64 bg-primary text-white flex flex-col fixed h-full">
            <div class="p-4 flex items-center space-x-2">
                <img src="{{ asset('image/logohauzhayag.jpg') }}" alt="Hauz Hayag Logo" class="h-16 w-auto rounded-lg shadow-md">
                <h1 class="text-2xl font-bold">Hauz Hayag</h1>
            </div>
            <nav class="mt-8 flex-1 flex flex-col">
                <a href="/dashboard" class="flex items-center px-4 py-3 bg-secondary hover:bg-secondary/80 transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
                <a href="/users" class="flex items-center px-4 py-3 hover:bg-secondary transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    User Management
                </a>
                <a href="/events" class="flex items-center px-4 py-3 hover:bg-secondary transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Events
                </a>
                <a href="/students" class="flex items-center px-4 py-3 hover:bg-secondary transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    Students
                </a>
                <a href="{{ route('admin.volunteers.index') }}" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Volunteers
                    </a>
                <a href="/jobs" class="flex items-center px-4 py-3 hover:bg-secondary transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Jobs
                </a>
                <div class="mt-auto pt-20">
                    <a href="/logout" class="flex items-center px-4 py-3 hover:bg-secondary transition-colors text-red-300 hover:text-red-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Logout
                    </a>
                </div>
            </nav>
        </div>
        <!-- Main Content Area -->
        <div class="flex-1 p-6 bg-gray-50 ml-64 overflow-y-auto h-screen">
            <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Page Header -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Student Management</h1>
                <p class="text-gray-600">Manage student applications and active students</p>
            </div>

            <!-- Stats Overview Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <!-- Pending Applications -->
                <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-yellow-500">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Pending Applications</p>
                            <p class="text-xl font-bold text-gray-800 mt-1">{{ $pendingApplicationsCount }}</p>
                        </div>
                        <div class="rounded-full bg-yellow-100 p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Approved Applications -->
                <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-green-500">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Approved Applications</p>
                            <p class="text-xl font-bold text-gray-800 mt-1">{{ $approvedApplicationsCount }}</p>
                        </div>
                        <div class="rounded-full bg-green-100 p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Active Students -->
                <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-blue-500">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Active Students</p>
                            <p class="text-xl font-bold text-gray-800 mt-1">{{ $activeStudentsCount }}</p>
                        </div>
                        <div class="rounded-full bg-blue-100 p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Filter Tools -->
            <div class="flex flex-wrap gap-3 mb-4">
                <div class="relative flex-grow max-w-md">
                    <input 
                        type="text" 
                        id="search" 
                        placeholder="Search students..." 
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-secondary"
                    >
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                
                <!-- Status Filter -->
                <div class="relative">
                    <select id="status-filter" class="appearance-none pl-3 pr-10 py-2 border border-gray-300 bg-white rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-secondary focus:border-secondary text-sm">
                        <option>All Statuses</option>
                        <option>Approved</option>
                        <option>Pending</option>
                        <option>Rejected</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                        </svg>
                    </div>
                </div>

                <!-- Type Filter -->
                <div class="relative">
                    <select id="type-filter" class="appearance-none pl-3 pr-10 py-2 border border-gray-300 bg-white rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-secondary focus:border-secondary text-sm">
                        <option>All Types</option>
                        <option>Home-based</option>
                        <option>Center-based</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="mb-6 border-b border-gray-200">
                <nav class="-mb-px flex space-x-8">
                    <a href="#applicants" class="border-primary text-primary whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Applicants
                    </a>
                    <a href="#students" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Students
                    </a>
                </nav>
            </div>

            <!-- Applicants Section -->
            <div id="applicants" class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Applicants</h2>
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transcript</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($applications as $application)
                                    @if ($application->status === 'pending')
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="h-10 w-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold">
                                                        {{ strtoupper(substr($application->full_name, 0, 1)) }}
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">{{ $application->full_name }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $application->email }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $application->phone_number }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <a href="{{ asset('storage/' . $application->transcript) }}" target="_blank" class="text-primary hover:text-primary-dark">
                                                    View Transcript
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    {{ $application->scholarship_type }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    {{ $application->status }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <form action="{{ route('admin.students.approve', $application->tracking_code) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="text-green-600 hover:text-green-900 bg-green-100 px-3 py-1 rounded">
                                                        Approve
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.students.reject', $application->tracking_code) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="text-red-600 hover:text-red-900 bg-red-100 px-3 py-1 rounded">
                                                        Reject
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                            No pending applications found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Students Section -->
            <div id="students" class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Students</h2>
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($students as $student)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="h-10 w-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold">
                                                    {{ strtoupper(substr($student->name, 0, 1)) }}
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $student->name }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $student->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $student->phone_number }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $student->scholarship_type }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ $student->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('users.edit', $student->id) }}" class="text-primary hover:text-primary-dark">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.students.destroyUser', $student->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                            No active students found
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

    <!-- JavaScript for Interactivity -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            const statusFilter = document.getElementById('status-filter');
            const typeFilter = document.getElementById('type-filter');
            const tabs = document.querySelectorAll('.mb-6 nav a');
            let activeTab = 'applicants'; // Default active tab

            // Add event listeners to tabs to switch active content
            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetTab = this.getAttribute('href').substring(1);

                    // Update active tab state
                    tabs.forEach(t => t.classList.remove('border-primary', 'text-primary', 'font-medium'));
                    this.classList.add('border-primary', 'text-primary', 'font-medium');

                    // Hide all tab content
                    document.querySelectorAll('#applicants, #students').forEach(section => section.style.display = 'none');

                    // Show the target tab content
                    document.getElementById(targetTab).style.display = 'block';

                    activeTab = targetTab; // Update active tab variable
                    filterTable(); // Re-apply filters for the new active tab
                });
            });

             // Initialize display: show applicants tab by default
             document.getElementById('students').style.display = 'none';
             document.querySelector('.mb-6 nav a[href="#applicants"]').classList.add('border-primary', 'text-primary', 'font-medium');


            // Search and filter functionality
            searchInput.addEventListener('keyup', function() {
                filterTable();
            });

            statusFilter.addEventListener('change', function() {
                filterTable();
            });

            typeFilter.addEventListener('change', function() {
                filterTable();
            });

            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase();
                const statusValue = statusFilter.value.toLowerCase();
                const typeValue = typeFilter.value.toLowerCase();

                // Determine which table to filter based on the active tab
                const currentTable = document.querySelector(`#${activeTab} table tbody`).querySelectorAll('tr');

                currentTable.forEach(row => {
                    const name = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
                    const email = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    // For applicants, type is in 5th column, status in 6th
                    // For students, type is in 4th column, status in 5th
                    const rowType = activeTab === 'applicants' ? row.querySelector('td:nth-child(5)').textContent.trim().toLowerCase() : row.querySelector('td:nth-child(4)').textContent.trim().toLowerCase();
                    const rowStatus = activeTab === 'applicants' ? row.querySelector('td:nth-child(6)').textContent.trim().toLowerCase() : row.querySelector('td:nth-child(5)').textContent.trim().toLowerCase();

                    const matchesSearch = name.includes(searchTerm) || email.includes(searchTerm);
                    
                    // Adjust status filtering for students tab
                    let matchesStatus;
                    if (activeTab === 'students' && statusValue === 'approved') {
                        matchesStatus = rowStatus === 'active';
                    } else {
                        matchesStatus = statusValue === 'all statuses' || rowStatus.includes(statusValue);
                    }
                    const matchesType = typeValue === 'all types' || rowType.includes(typeValue);

                    if (matchesSearch && matchesStatus && matchesType) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            // Initial filter application on page load
            filterTable();
        });
    </script>
</x-app-layout>