@extends('layouts.admin')

@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="bg-white p-4 flex justify-between items-center shadow-sm rounded-lg mb-6">
        <h2 class="text-xl flex items-center">
            <svg class="w-6 h-6 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            Volunteer Management
        </h2>
        <div class="flex items-center space-x-3">
            <span class="text-gray-600">Admin</span>
            <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white font-medium">
                AD
            </div>
        </div>
    </div>

    <!-- Tab Navigation -->
    <div class="bg-white border-b border-gray-200 rounded-t-lg">
        <nav class="flex space-x-8 px-6" aria-label="Tabs">
            <button onclick="showTab('volunteers')" id="volunteers-tab" class="tab-button border-b-2 border-primary text-primary py-4 px-1 text-sm font-medium transition-colors duration-300 ease-in-out">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 515.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                All Volunteers
            </button>
            <button onclick="showTab('event-applications')" id="event-applications-tab" class="tab-button border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 py-4 px-1 text-sm font-medium transition-colors duration-300 ease-in-out">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Event Applications
            </button>
        </nav>
    </div>

    <!-- Tab Content -->
    <div id="volunteers-content" class="tab-content bg-white rounded-b-lg shadow">
        <div class="p-6">
            <!-- Page Header -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">All Volunteers</h1>
                <p class="text-gray-600">Manage and review volunteer accounts</p>
            </div>

            <!-- Stats Overview Section -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <!-- Total Volunteers -->
                <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-blue-500">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Volunteers</p>
                            <p class="text-xl font-bold text-gray-800 mt-1">{{ $totalVolunteersCount ?? $volunteers->total() }}</p>
                        </div>
                        <div class="rounded-full bg-blue-100 p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 515.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Active Volunteers -->
                <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-green-500">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Active Volunteers</p>
                            <p class="text-xl font-bold text-gray-800 mt-1">
                                {{ $activeVolunteersCount ?? $volunteers->where('status', 'active')->count() }}
                            </p>
                        </div>
                        <div class="rounded-full bg-green-100 p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Inactive Volunteers -->
                <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-red-500">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Inactive Volunteers</p>
                            <p class="text-xl font-bold text-gray-800 mt-1">
                                {{ $inactiveVolunteersCount ?? $volunteers->where('status', 'inactive')->count() }}
                            </p>
                        </div>
                        <div class="rounded-full bg-red-100 p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Pending Volunteers -->
                <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-yellow-500">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Pending Volunteers</p>
                            <p class="text-xl font-bold text-gray-800 mt-1">
                                {{ $totalPendingCount ?? ($pendingVolunteersCount + $pendingEventApplicationsCount) ?? $volunteers->where('status', 'pending')->count() }}
                            </p>
                        </div>
                        <div class="rounded-full bg-yellow-100 p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Filter Tools -->
            <form id="volunteer-search-form" method="GET" class="flex flex-wrap gap-3 mb-4">
                <input type="hidden" name="role" value="volunteer">
                <div class="relative flex-grow max-w-md">
                    <input 
                        type="text" 
                        name="search" 
                        id="volunteer-search-input"
                        placeholder="Search volunteers..."
                        value="{{ request('search') }}"
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
                    <select name="status" class="appearance-none pl-3 pr-10 py-2 border border-gray-300 bg-white rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-secondary focus:border-secondary text-sm volunteer-filter-dropdown">
                        <option value="">All Statuses</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                        </svg>
                    </div>
                </div>

                <a href="{{ route('users.create', ['role' => 'volunteer']) }}" class="bg-secondary text-white px-4 py-2 rounded-lg hover:bg-secondary/80 transition-colors">
                    Add Volunteer
                </a>
            </form>

            <!-- Volunteers Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Volunteer</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone Number</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($volunteers as $volunteer)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            @if($volunteer->profile_picture)
                                                <img src="{{ Storage::url($volunteer->profile_picture) }}" alt="{{ $volunteer->name }}" class="w-10 h-10 rounded-full object-cover">
                                            @else
                                                <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold">
                                                    {{ strtoupper(substr($volunteer->name, 0, 1)) }}
                                                </div>
                                            @endif
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $volunteer->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $volunteer->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs rounded-full 
                                            @if($volunteer->status == 'active') bg-green-100 text-green-800
                                            @elseif($volunteer->status == 'inactive') bg-red-100 text-red-800
                                            @else bg-yellow-100 text-yellow-800
                                            @endif">
                                            {{ ucfirst($volunteer->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $volunteer->phone ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @if($volunteer->status == 'pending')
                                            <form action="{{ route('admin.volunteers.approve', $volunteer) }}" method="POST" class="inline-block">
                                                @csrf
                                                <button type="submit" class="text-green-600 hover:text-green-900 mr-3">Approve</button>
                                            </form>
                                            <form action="{{ route('admin.volunteers.reject', $volunteer) }}" method="POST" class="inline-block">
                                                @csrf
                                                <button type="submit" class="text-red-600 hover:text-red-900">Reject</button>
                                            </form>
                                        @else
                                            <a href="{{ route('users.edit', $volunteer) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                            <form action="{{ route('users.destroy', $volunteer) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this volunteer?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="p-6">
                    {{ $volunteers->links() }}
                </div>
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

        // Submit form on Enter in search
        document.getElementById('volunteer-search-input').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('volunteer-search-form').submit();
            }
        });
        // Submit form on dropdown change
        document.querySelectorAll('.volunteer-filter-dropdown').forEach(function(dropdown) {
            dropdown.addEventListener('change', function() {
                document.getElementById('volunteer-search-form').submit();
            });
        });
    });
</script>
@endpush
