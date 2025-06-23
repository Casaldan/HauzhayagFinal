<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class VolunteerJobListingCsvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Importing volunteer job listings from CSV...');
        $this->command->warn('All jobs will be marked as PENDING for admin approval');

        // Run the volunteer CSV import command
        Artisan::call('volunteer:import-jobs', [
            'file' => 'volunteer_job_listings.csv',
            '--user-id' => 2 // Assuming user ID 2 is a volunteer
        ]);

        $this->command->info('Volunteer job listings imported successfully!');
        $this->command->line(Artisan::output());
    }
}
