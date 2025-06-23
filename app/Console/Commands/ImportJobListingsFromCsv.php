<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\JobListing;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ImportJobListingsFromCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jobs:import-csv {file?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import job listings from CSV file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = $this->argument('file') ?? 'job_listings.csv';
        $filepath = storage_path('app/' . $filename);

        if (!file_exists($filepath)) {
            $this->error("CSV file not found: {$filepath}");
            $this->info("Please place your CSV file in: storage/app/{$filename}");
            return 1;
        }

        $this->info("Importing job listings from: {$filename}");

        $handle = fopen($filepath, 'r');
        $header = fgetcsv($handle); // Read header row

        $imported = 0;
        $errors = 0;

        while (($row = fgetcsv($handle)) !== false) {
            try {
                $data = array_combine($header, $row);

                // Clean and validate data
                $jobData = $this->prepareJobData($data);

                JobListing::create($jobData);
                $imported++;

                $this->line("✓ Imported: {$jobData['title']} at {$jobData['company_name']}");

            } catch (\Exception $e) {
                $errors++;
                $this->error("✗ Error importing row: " . $e->getMessage());
            }
        }

        fclose($handle);

        $this->info("\n=== Import Summary ===");
        $this->info("Successfully imported: {$imported} job listings");
        if ($errors > 0) {
            $this->warn("Errors encountered: {$errors}");
        }

        return 0;
    }

    private function prepareJobData($data)
    {
        return [
            'title' => $data['title'] ?? 'Untitled Position',
            'company_name' => $data['company_name'] ?? $data['company'] ?? 'Unknown Company',
            'description' => $data['description'] ?? 'No description provided',
            'location' => $data['location'] ?? 'Remote',
            'employment_type' => $data['employment_type'] ?? 'Full-time',
            'type' => $data['type'] ?? $data['employment_type'] ?? 'Full-time',
            'category' => $data['category'] ?? 'General',
            'role' => $data['role'] ?? $data['title'] ?? 'General Role',
            'qualifications' => $data['qualifications'] ?? 'To be discussed',
            'requirements' => $data['requirements'] ?? null,
            'benefits' => $data['benefits'] ?? null,
            'contact_person' => $data['contact_person'] ?? 'HR Department',
            'contact_email' => $data['contact_email'] ?? 'hr@company.com',
            'contact_phone' => $data['contact_phone'] ?? null,
            'salary_min' => !empty($data['salary_min']) ? (float)$data['salary_min'] : null,
            'salary_max' => !empty($data['salary_max']) ? (float)$data['salary_max'] : null,
            'hours_per_week' => $data['hours_per_week'] ?? '40',
            'start_date' => !empty($data['start_date']) ? Carbon::parse($data['start_date']) : null,
            'end_date' => !empty($data['end_date']) ? Carbon::parse($data['end_date']) : null,
            'expires_at' => !empty($data['expires_at']) ? Carbon::parse($data['expires_at']) : Carbon::now()->addMonths(3),
            'expiry_date' => !empty($data['expiry_date']) ? Carbon::parse($data['expiry_date']) : Carbon::now()->addMonths(3)->toDateString(),
            'status' => $data['status'] ?? 'approved',
            'is_admin_posted' => true,
            'posted_by' => 1, // Assuming admin user ID is 1
        ];
    }
}
