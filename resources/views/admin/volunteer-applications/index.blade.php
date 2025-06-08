@extends('layouts.admin')

@section('title', 'Event Applications')

@section('content')
<div class="p-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Volunteer Event Applications</h1>
        <p class="text-gray-600 mt-2">Manage volunteer applications for events</p>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

                <!-- Applications Table -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applicant</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Application Reason</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applied Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($applications as $application)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">{{ $application->full_name }}</div>
                                                <div class="text-sm text-gray-500">{{ $application->email }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $application->event->title }}</div>
                                            <div class="text-sm text-gray-500">{{ $application->event->location }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $application->application_reason }}">
                                                {{ Str::limit($application->application_reason, 100) }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $application->applied_at ? $application->applied_at->format('M d, Y') : $application->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($application->status === 'approved') bg-green-100 text-green-800
                                                @elseif($application->status === 'rejected') bg-red-100 text-red-800
                                                @else bg-yellow-100 text-yellow-800 @endif">
                                                {{ ucfirst($application->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                            @if($application->status === 'pending')
                                                <button onclick="updateStatus({{ $application->id }}, 'approved')" 
                                                        class="bg-green-600 text-white px-3 py-1 rounded-lg hover:bg-green-700 transition-all duration-300 ease-in-out transform hover:scale-105">
                                                    <i class="fas fa-check mr-1"></i> Approve
                                                </button>
                                                
                                                <button onclick="updateStatus({{ $application->id }}, 'rejected')" 
                                                        class="bg-red-600 text-white px-3 py-1 rounded-lg hover:bg-red-700 transition-all duration-300 ease-in-out transform hover:scale-105">
                                                    <i class="fas fa-times mr-1"></i> Reject
                                                </button>
                                            @else
                                                <span class="text-gray-500">{{ ucfirst($application->status) }}</span>
                                            @endif
                                            
                                            <button onclick="viewApplication({{ $application->id }})" 
                                                    class="bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700 transition-all duration-300 ease-in-out transform hover:scale-105">
                                                <i class="fas fa-eye mr-1"></i> View
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center">
                                            <div class="text-gray-500">
                                                <i class="fas fa-inbox text-4xl mb-4"></i>
                                                <p class="text-lg">No volunteer applications yet</p>
                                                <p class="text-sm">Applications will appear here when volunteers register for events</p>
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
</div>

<!-- Application Details Modal -->
<div id="applicationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Application Details</h3>
            <div id="applicationDetails" class="space-y-2">
                <!-- Details will be populated by JavaScript -->
            </div>
            <div class="mt-6 flex justify-end">
                <button onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function viewApplication(id) {
    // Fetch application details and show modal
    fetch(`/admin/volunteer-applications/${id}`)
        .then(response => response.json())
        .then(data => {
            const details = document.getElementById('applicationDetails');
            details.innerHTML = `
                <p><strong>Name:</strong> ${data.full_name}</p>
                <p><strong>Email:</strong> ${data.email}</p>
                <p><strong>Event:</strong> ${data.event.title}</p>
                <p><strong>Application Reason:</strong> ${data.application_reason}</p>
                <p><strong>Status:</strong> ${data.status}</p>
                <p><strong>Applied:</strong> ${data.applied_at ? new Date(data.applied_at).toLocaleDateString() : new Date(data.created_at).toLocaleDateString()}</p>
                ${data.admin_notes ? `<p><strong>Admin Notes:</strong> ${data.admin_notes}</p>` : ''}
            `;
            document.getElementById('applicationModal').classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error loading application details');
        });
}

function closeModal() {
    document.getElementById('applicationModal').classList.add('hidden');
}

function updateStatus(id, status) {
    if (!confirm(`Are you sure you want to ${status} this application?`)) {
        return;
    }

    fetch(`/admin/volunteer-applications/${id}/status`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ status })
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while updating the status.');
    });
}
</script>
@endpush
@endsection
