@extends('layouts.app')

@section('content')
<div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    @include('volunteers.sidebar')
    <!-- Main Content -->
    <div class="flex-1 p-6 bg-gray-50 ml-64 overflow-y-auto h-screen">
        <h1 class="text-2xl font-bold mb-6">Upcoming Events</h1>
        <div class="space-y-4">
            @forelse($events as $event)
                <div class="bg-white rounded-lg shadow p-4 flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-semibold">{{ $event->title }}</h2>
                        <p class="text-gray-600">{{ \Carbon\Carbon::parse($event->start_date)->format('F j, Y g:i A') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('F j, Y g:i A') }}</p>
                        <p class="text-gray-500">{{ Str::limit($event->description, 100) }}</p>
                    </div>
                    <button onclick="openRegistrationModal({{ $event->id }}, '{{ $event->title }}')" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Register Now</button>
                </div>
            @empty
                <div class="text-center text-gray-500 py-4">No upcoming events found.</div>
            @endforelse
        </div>
    </div>
</div>

<!-- Registration Modal -->
<div id="registrationModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 hidden">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md mx-4 relative">
        <button onclick="closeRegistrationModal()" class="absolute top-4 right-4 text-gray-400 hover:text-black text-2xl font-bold">&times;</button>
        <h2 class="text-2xl font-bold mb-6 text-center">Register for Event</h2>
        <p id="eventTitle" class="text-center text-gray-600 mb-6"></p>

        <form id="registrationForm" class="space-y-4">
            <input type="hidden" id="eventId" name="event_id">

            <div>
                <label for="fullName" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                <input type="text" id="fullName" name="full_name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" value="{{ auth()->user()->name }}">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                <input type="email" id="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" value="{{ auth()->user()->email }}">
            </div>

            <div>
                <label for="phoneNumber" class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                <input type="tel" id="phoneNumber" name="phone_number" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
            </div>

            <div>
                <label for="applicationReason" class="block text-sm font-medium text-gray-700 mb-2">Why do you want to volunteer for this event? *</label>
                <textarea id="applicationReason" name="application_reason" rows="4" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="Tell us why you're interested in volunteering for this event..."></textarea>
            </div>

            <div class="flex justify-end space-x-4 pt-4">
                <button type="button" onclick="closeRegistrationModal()" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Cancel
                </button>
                <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">
                    Submit Application
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openRegistrationModal(eventId, eventTitle) {
    document.getElementById('eventId').value = eventId;
    document.getElementById('eventTitle').textContent = eventTitle;
    document.getElementById('registrationModal').classList.remove('hidden');
}

function closeRegistrationModal() {
    document.getElementById('registrationModal').classList.add('hidden');
    document.getElementById('registrationForm').reset();
}

document.getElementById('registrationForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const data = Object.fromEntries(formData);

    fetch('/volunteer/event-registration', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const trackingCode = data.tracking_code;
            const message = `Application submitted successfully!\n\nYour tracking code is: ${trackingCode}\n\nPlease check your email for confirmation and save this tracking code to check your application status.`;
            alert(message);

            // Show tracking code modal or redirect to tracking page
            if (confirm('Would you like to track your application status now?')) {
                window.open(`/volunteer/track-application?code=${trackingCode}`, '_blank');
            }

            closeRegistrationModal();
            location.reload(); // Refresh to show updated status
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
});
</script>
@endsection