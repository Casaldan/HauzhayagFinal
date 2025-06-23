<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class JobListingCsvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Importing job listings from CSV...');

        // Run the CSV import command
        Artisan::call('jobs:import-csv', ['file' => 'job_listings.csv']);

        $this->command->info('Job listings imported successfully!');
        $this->command->line(Artisan::output());
    }
}
