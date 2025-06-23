<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(10);
        $totalEventsCount = Event::count();
        $activeEventsCount = Event::where('status', 'active')->count();
        $completedEventsCount = Event::where('status', 'completed')->count();
        $upcomingEventsCount = Event::where('start_date', '>', now())->count();

        // Get upcoming events for the calendar/list view
        $upcomingEvents = Event::where('start_date', '>', now())
            ->orderBy('start_date', 'asc')
            ->take(10)
            ->get();

        return view('admin.events.index', compact(
            'events',
            'totalEventsCount',
            'activeEventsCount',
            'completedEventsCount',
            'upcomingEventsCount',
            'upcomingEvents'
        ));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'what_are_we_looking_for' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|string|max:255',
        ]);

        $validated['status'] = 'active';
        $validated['is_admin_posted'] = true;
        $validated['created_by'] = auth()->id();

        $event = Event::create($validated);

        // Notify students about the new event
        $students = \App\Models\User::where('role', 'student')->get();
        foreach ($students as $student) {
            $student->notify(new \App\Notifications\NewEventNotification($event));
        }

        return redirect()->route('events.index')
            ->with('success', 'Event created successfully.');
    }

    public function show(Event $event)
    {
        // Check if this is an API request
        if (request()->is('api/*')) {
            return response()->json($event);
        }

        return view('admin.events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'what_are_we_looking_for' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|string|max:255',
        ]);

        $event->update($validated);

        return redirect()->route('events.show', $event)
            ->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Event deleted successfully.');
    }

    public function getEventsJson()
    {
        $events = Event::all()->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->start_date->format('Y-m-d\TH:i:s'),
                'end' => $event->end_date->format('Y-m-d\TH:i:s'),
            ];
        });

        return response()->json($events);
    }

    public function getUpcomingEvents()
    {
        $events = Event::where('start_date', '>=', Carbon::now())
            ->notCompleted()
            ->orderBy('start_date', 'asc')
            ->take(5)
            ->get();

        return response()->json($events);
    }

    public function importCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048'
        ]);

        try {
            $file = $request->file('csv_file');
            $path = $file->getRealPath();
            $handle = fopen($path, 'r');

            // Read header row
            $header = fgetcsv($handle);

            $imported = 0;
            $errors = [];

            while (($row = fgetcsv($handle)) !== false) {
                try {
                    $data = array_combine($header, $row);

                    // Prepare event data
                    $eventData = $this->prepareEventDataFromCsv($data);

                    $event = Event::create($eventData);

                    // Notify students about the new event
                    $students = \App\Models\User::where('role', 'student')->get();
                    foreach ($students as $student) {
                        $student->notify(new \App\Notifications\NewEventNotification($event));
                    }

                    $imported++;

                } catch (\Exception $e) {
                    $errors[] = "Row error: " . $e->getMessage();
                }
            }

            fclose($handle);

            $message = "Successfully imported {$imported} events.";
            if (count($errors) > 0) {
                $message .= " " . count($errors) . " errors encountered.";
            }

            return redirect()->route('events.index')
                ->with('success', $message);

        } catch (\Exception $e) {
            return redirect()->route('events.index')
                ->with('error', 'Import failed: ' . $e->getMessage());
        }
    }

    public function downloadTemplate()
    {
        $headers = [
            'title',
            'description',
            'start_date',
            'end_date',
            'location',
            'status'
        ];

        $filename = 'events_template.csv';
        $handle = fopen('php://output', 'w');

        // Set headers for download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // Write CSV header
        fputcsv($handle, $headers);

        // Write sample data
        fputcsv($handle, [
            'Community Cleanup Drive',
            'Join us for a community cleanup initiative to make our neighborhood cleaner and greener. Volunteers will be provided with cleaning materials and refreshments.',
            '2024-12-15 09:00:00',
            '2024-12-15 15:00:00',
            'Barangay Central Park, Cebu City',
            'active'
        ]);

        fputcsv($handle, [
            'Youth Leadership Workshop',
            'Empower young leaders through interactive workshops on leadership skills, communication, and community engagement.',
            '2024-12-20 14:00:00',
            '2024-12-20 17:00:00',
            'Community Center, Makati City',
            'active'
        ]);

        fputcsv($handle, [
            'Senior Citizens Health Fair',
            'Free health screening and consultation for senior citizens. Medical professionals will provide basic health checkups and health education.',
            '2024-12-25 08:00:00',
            '2024-12-25 12:00:00',
            'Municipal Health Center, Quezon City',
            'active'
        ]);

        fclose($handle);
        exit;
    }

    private function prepareEventDataFromCsv($data)
    {
        return [
            'title' => $data['title'] ?? 'Untitled Event',
            'description' => $data['description'] ?? 'No description provided',
            'start_date' => !empty($data['start_date']) ? Carbon::parse($data['start_date']) : Carbon::now()->addDays(7),
            'end_date' => !empty($data['end_date']) ? Carbon::parse($data['end_date']) : Carbon::now()->addDays(7)->addHours(3),
            'location' => $data['location'] ?? 'TBD',
            'status' => $data['status'] ?? 'active',
            'is_admin_posted' => true,
            'created_by' => auth()->id() ?? 1,
        ];
    }
}