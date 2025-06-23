<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use Carbon\Carbon;

class ImportEventsFromCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'events:import-csv {file?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import events from CSV file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = $this->argument('file') ?? 'events.csv';
        $filepath = storage_path('app/' . $filename);

        if (!file_exists($filepath)) {
            $this->error("CSV file not found: {$filepath}");
            $this->info("Please place your CSV file in: storage/app/{$filename}");
            return 1;
        }

        $this->info("Importing events from: {$filename}");

        $handle = fopen($filepath, 'r');
        $header = fgetcsv($handle); // Read header row

        $imported = 0;
        $errors = 0;

        while (($row = fgetcsv($handle)) !== false) {
            try {
                $data = array_combine($header, $row);

                // Clean and validate data
                $eventData = $this->prepareEventData($data);

                $event = Event::create($eventData);

                // Notify students about the new event
                $students = \App\Models\User::where('role', 'student')->get();
                foreach ($students as $student) {
                    $student->notify(new \App\Notifications\NewEventNotification($event));
                }

                $imported++;

                $this->line("✓ Imported: {$eventData['title']} on {$eventData['start_date']->format('M d, Y')}");

            } catch (\Exception $e) {
                $errors++;
                $this->error("✗ Error importing row: " . $e->getMessage());
            }
        }

        fclose($handle);

        $this->info("\n=== Import Summary ===");
        $this->info("Successfully imported: {$imported} events");
        if ($errors > 0) {
            $this->warn("Errors encountered: {$errors}");
        }

        return 0;
    }

    private function prepareEventData($data)
    {
        return [
            'title' => $data['title'] ?? 'Untitled Event',
            'description' => $data['description'] ?? 'No description provided',
            'start_date' => !empty($data['start_date']) ? Carbon::parse($data['start_date']) : Carbon::now()->addDays(7),
            'end_date' => !empty($data['end_date']) ? Carbon::parse($data['end_date']) : Carbon::now()->addDays(7)->addHours(3),
            'location' => $data['location'] ?? 'TBD',
            'status' => $data['status'] ?? 'active',
            'is_admin_posted' => true,
            'created_by' => 1, // Assuming admin user ID is 1
        ];
    }
}
