<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\JobListing;
use Carbon\Carbon;

class ImportVolunteerJobsFromCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'volunteer:import-jobs {file?} {--user-id=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import volunteer job listings from CSV file (all jobs will be pending admin approval)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = $this->argument('file') ?? 'volunteer_job_listings.csv';
        $filepath = storage_path('app/' . $filename);
        $userId = $this->option('user-id');

        if (!file_exists($filepath)) {
            $this->error("CSV file not found: {$filepath}");
            $this->info("Please place your CSV file in: storage/app/{$filename}");
            return 1;
        }

        $this->info("Importing volunteer job listings from: {$filename}");
        $this->info("All jobs will be marked as PENDING for admin approval");

        $handle = fopen($filepath, 'r');
        $header = fgetcsv($handle); // Read header row

        $imported = 0;
        $errors = 0;

        while (($row = fgetcsv($handle)) !== false) {
            try {
                $data = array_combine($header, $row);

                // Clean and validate data for volunteer submission
                $jobData = $this->prepareVolunteerJobData($data, $userId);

                JobListing::create($jobData);
                $imported++;

                $this->line("✓ Imported (PENDING): {$jobData['title']} at {$jobData['company_name']}");

            } catch (\Exception $e) {
                $errors++;
                $this->error("✗ Error importing row: " . $e->getMessage());
            }
        }

        fclose($handle);

        $this->info("\n=== Volunteer Import Summary ===");
        $this->info("Successfully imported: {$imported} job listings");
        $this->warn("Status: ALL JOBS ARE PENDING ADMIN APPROVAL");
        if ($errors > 0) {
            $this->warn("Errors encountered: {$errors}");
        }

        return 0;
    }

    private function prepareVolunteerJobData($data, $userId)
    {
        return [
            'title' => $data['title'] ?? 'Untitled Position',
            'company_name' => $data['company_name'] ?? 'Unknown Organization',
            'role' => $data['role'] ?? $data['title'] ?? 'General Role',
            'description' => $data['description'] ?? 'No description provided',
            'qualifications' => $data['qualifications'] ?? 'To be discussed',
            'employment_type' => $data['employment_type'] ?? 'Part-time',
            'type' => $data['employment_type'] ?? 'Part-time',
            'location' => $data['location'] ?? 'Remote',
            'category' => $data['category'] ?? 'Community Service',
            'contact_person' => $data['contact_person'] ?? 'Contact Person',
            'contact_email' => $data['contact_email'] ?? 'contact@organization.gmail.com',
            'contact_phone' => $data['contact_phone'] ?? null,
            'salary_min' => !empty($data['salary_min']) ? (float)$data['salary_min'] : null,
            'salary_max' => !empty($data['salary_max']) ? (float)$data['salary_max'] : null,
            'expires_at' => !empty($data['expires_at']) ? Carbon::parse($data['expires_at']) : Carbon::now()->addMonths(2),
            'benefits' => $data['benefits'] ?? null,
            'requirements' => $data['requirements'] ?? null,
            'status' => 'pending', // All volunteer imports are pending
            'is_admin_posted' => false, // Volunteer posted
            'posted_by' => $userId,
        ];
    }
}
