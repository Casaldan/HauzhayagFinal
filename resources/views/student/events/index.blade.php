<x-app-layout>
    <div class="flex">
        <!-- Sidebar (reuse from student dashboard) -->
        <div class="w-64 min-h-screen bg-[#1B4B5A] text-white flex flex-col">
            <div class="p-4 flex items-center space-x-2">
                <img src="{{ asset('image/logohauzhayag.jpg') }}" alt="Hauz Hayag Logo" class="h-16 w-auto rounded-lg shadow-md">
                <h1 class="text-2xl font-bold">Hauz Hayag</h1>
            </div>
            <nav class="mt-8 flex-1 flex flex-col">
                <a href="{{ route('student.dashboard') }}" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('jobs.listings') }}" class="flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M9 12h6m-3-3v6m-7 4h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Job Listings
                </a>
                <a href="{{ route('student.events.index') }}" class="flex items-center px-4 py-3 bg-[#2C5F6E] hover:bg-[#2C5F6E] transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Events
                </a>
                <div class="mt-auto pt-20">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-4 py-3 hover:bg-[#2C5F6E] transition-colors text-red-300 hover:text-red-200">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8 bg-gray-50">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Available Events</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($events as $event)
                    <div class="bg-white rounded-lg shadow-md p-6 flex flex-col justify-between">
                        <div>
                            <h2 class="text-xl font-semibold text-primary mb-2">{{ $event->title }}</h2>
                            <p class="text-gray-700 mb-2"><span class="font-semibold">Date:</span> {{ \Carbon\Carbon::parse($event->start_date)->format('F j, Y') }}</p>
                            <p class="text-gray-700 mb-2"><span class="font-semibold">Time:</span> {{ \Carbon\Carbon::parse($event->start_date)->format('g:i A') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('g:i A') }}</p>
                            <p class="text-gray-700 mb-2"><span class="font-semibold">Location:</span> {{ $event->location }}</p>
                            <p class="text-gray-700 mb-2"><span class="font-semibold">Description:</span> {{ $event->description }}</p>
                        </div>
                        {{-- You can add a link to view event details if you have a show route for student events --}}
                        {{-- <div class="mt-4">
                            <a href="{{ route('student.events.show', $event->id) }}" class="text-blue-600 hover:underline">View Details</a>
                        </div> --}}
                    </div>
                @empty
                    <div class="col-span-3 text-center text-gray-500">
                        No events available at the moment.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout> 