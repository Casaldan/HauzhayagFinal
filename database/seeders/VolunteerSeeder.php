<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Volunteer;
use Carbon\Carbon;

class VolunteerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create test volunteers with different statuses for testing
        $volunteers = [
            [
                'name' => 'Test Volunteer One',
                'email' => 'testvolunteer1@gmail.com',
                'phone' => '09123456789',
                'skills' => json_encode(['Teaching', 'Event Management']),
                'status' => 'Pending',
                'notes' => 'Test volunteer for approval testing',
                'start_date' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Test Volunteer Two',
                'email' => 'testvolunteer2@gmail.com',
                'phone' => '09987654321',
                'skills' => json_encode(['Tutoring', 'Community Outreach']),
                'status' => 'Pending',
                'notes' => 'Another test volunteer for approval testing',
                'start_date' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Already Active Volunteer',
                'email' => 'activevolunteer@gmail.com',
                'phone' => '09111222333',
                'skills' => json_encode(['Administration']),
                'status' => 'Active',
                'notes' => 'Already approved volunteer for testing',
                'start_date' => Carbon::now()->subDays(30),
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->subDays(30),
            ],
        ];

        foreach ($volunteers as $volunteer) {
            Volunteer::create($volunteer);
        }

        $this->command->info('Test volunteers created successfully!');
    }
}
