<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class EventCsvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Importing events from CSV...');

        // Run the CSV import command
        Artisan::call('events:import-csv', ['file' => 'events.csv']);

        $this->command->info('Events imported successfully!');
        $this->command->line(Artisan::output());
    }
}
