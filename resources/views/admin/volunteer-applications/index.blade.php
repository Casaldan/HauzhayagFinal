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
<div id="applicationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-10 mx-auto p-6 border max-w-4xl shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-900">Volunteer Application Details</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Application Information -->
                <div class="space-y-4">
                    <div id="applicationDetails" class="space-y-3">
                        <!-- Details will be populated by JavaScript -->
                    </div>
                </div>

                <!-- Uploaded Image -->
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold text-gray-900">Uploaded Valid ID</h4>
                    <div id="uploadedImageContainer" class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                        <!-- Image will be populated by JavaScript -->
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-end space-x-3">
                <button onclick="closeModal()" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition-colors">
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
            // Populate application details
            const details = document.getElementById('applicationDetails');
            details.innerHTML = `
                <div class="bg-gray-50 p-4 rounded-lg space-y-3">
                    <div class="grid grid-cols-1 gap-3">
                        <div>
                            <label class="text-sm font-medium text-gray-600">Full Name</label>
                            <p class="text-gray-900 font-medium">${data.full_name}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Email Address</label>
                            <p class="text-gray-900">${data.email}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Phone Number</label>
                            <p class="text-gray-900">${data.phone_number || 'Not provided'}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Event</label>
                            <p class="text-gray-900 font-medium">${data.event.title}</p>
                            <p class="text-sm text-gray-600">${data.event.location}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Tracking Code</label>
                            <p class="text-gray-900 font-mono bg-blue-100 px-2 py-1 rounded inline-block">${data.tracking_code}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Application Reason</label>
                            <p class="text-gray-900">${data.application_reason}</p>
                        </div>
                        ${data.volunteer_description ? `
                        <div>
                            <label class="text-sm font-medium text-gray-600">Volunteer Description</label>
                            <p class="text-gray-900">${data.volunteer_description}</p>
                        </div>
                        ` : ''}
                        <div>
                            <label class="text-sm font-medium text-gray-600">Status</label>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full
                                ${data.status === 'approved' ? 'bg-green-100 text-green-800' :
                                  data.status === 'rejected' ? 'bg-red-100 text-red-800' :
                                  'bg-yellow-100 text-yellow-800'}">
                                ${data.status.charAt(0).toUpperCase() + data.status.slice(1)}
                            </span>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Applied Date</label>
                            <p class="text-gray-900">${data.applied_at ? new Date(data.applied_at).toLocaleDateString() : new Date(data.created_at).toLocaleDateString()}</p>
                        </div>
                        ${data.admin_notes ? `
                        <div>
                            <label class="text-sm font-medium text-gray-600">Admin Notes</label>
                            <p class="text-gray-900">${data.admin_notes}</p>
                        </div>
                        ` : ''}
                    </div>
                </div>
            `;

            // Populate uploaded image
            const imageContainer = document.getElementById('uploadedImageContainer');
            if (data.valid_id_url) {
                const fileExtension = data.valid_id_path.split('.').pop().toLowerCase();
                if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension)) {
                    // Display image
                    imageContainer.innerHTML = `
                        <div class="space-y-3">
                            <img src="${data.valid_id_url}" alt="Valid ID" class="max-w-full h-auto rounded-lg shadow-md cursor-pointer" onclick="openImageModal('${data.valid_id_url}')">
                            <p class="text-sm text-gray-600">Click image to view full size</p>
                            <a href="${data.valid_id_url}" target="_blank" class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm">
                                <i class="fas fa-external-link-alt mr-1"></i>
                                Open in new tab
                            </a>
                        </div>
                    `;
                } else if (fileExtension === 'pdf') {
                    // Display PDF link
                    imageContainer.innerHTML = `
                        <div class="space-y-3">
                            <div class="flex items-center justify-center h-32 bg-red-50 rounded-lg">
                                <i class="fas fa-file-pdf text-red-500 text-4xl"></i>
                            </div>
                            <p class="text-sm text-gray-600">PDF Document</p>
                            <a href="${data.valid_id_url}" target="_blank" class="inline-flex items-center bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">
                                <i class="fas fa-file-pdf mr-2"></i>
                                View PDF
                            </a>
                        </div>
                    `;
                } else {
                    // Display generic file
                    imageContainer.innerHTML = `
                        <div class="space-y-3">
                            <div class="flex items-center justify-center h-32 bg-gray-50 rounded-lg">
                                <i class="fas fa-file text-gray-400 text-4xl"></i>
                            </div>
                            <p class="text-sm text-gray-600">Uploaded File</p>
                            <a href="${data.valid_id_url}" target="_blank" class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-download mr-2"></i>
                                Download File
                            </a>
                        </div>
                    `;
                }
            } else {
                imageContainer.innerHTML = `
                    <div class="flex items-center justify-center h-32 text-gray-400">
                        <div class="text-center">
                            <i class="fas fa-image text-3xl mb-2"></i>
                            <p>No image uploaded</p>
                        </div>
                    </div>
                `;
            }

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

function openImageModal(imageUrl) {
    // Create image modal if it doesn't exist
    let imageModal = document.getElementById('imageModal');
    if (!imageModal) {
        imageModal = document.createElement('div');
        imageModal.id = 'imageModal';
        imageModal.className = 'fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden';
        imageModal.innerHTML = `
            <div class="relative max-w-4xl max-h-full p-4">
                <button onclick="closeImageModal()" class="absolute top-2 right-2 text-white hover:text-gray-300 z-10">
                    <i class="fas fa-times text-2xl"></i>
                </button>
                <img id="modalImage" src="" alt="Full size image" class="max-w-full max-h-full object-contain rounded-lg">
            </div>
        `;
        document.body.appendChild(imageModal);
    }

    // Set image source and show modal
    document.getElementById('modalImage').src = imageUrl;
    imageModal.classList.remove('hidden');
}

function closeImageModal() {
    const imageModal = document.getElementById('imageModal');
    if (imageModal) {
        imageModal.classList.add('hidden');
    }
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
        body: JSON.stringify({
            status: status,
            admin_notes: ''
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            if (data.redirect_to_user_management && data.user_id) {
                // Show success message and redirect to user management
                alert(data.message + '\n\nRedirecting to User Management to update account details...');
                window.location.href = `/users/${data.user_id}/edit?from=volunteer_approval&new_user=${data.is_new_user}&default_password=${data.default_password || ''}`;
            } else {
                alert(data.message);
                location.reload();
            }
        } else if (data.message) {
            alert(data.message);
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
