<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VolunteerEventApplication;
use App\Models\Event;

class VolunteerEventApplicationSeeder extends Seeder
{
    public function run()
    {
        // Get the first event
        $event = Event::first();
        
        if ($event) {
            // Create some test volunteer event applications
            VolunteerEventApplication::create([
                'event_id' => $event->id,
                'full_name' => 'Lito Milabo',
                'email' => 'lito@gmail.com',
                'phone_number' => '(555) 123-4567',
                'application_reason' => 'I want to help with the Christmas party and contribute to the community.',
                'status' => 'pending',
                'applied_at' => now(),
            ]);

            VolunteerEventApplication::create([
                'event_id' => $event->id,
                'full_name' => 'Maria Santos',
                'email' => 'maria@gmail.com',
                'phone_number' => '(555) 987-6543',
                'application_reason' => 'I have experience in event management and would love to volunteer.',
                'status' => 'pending',
                'applied_at' => now(),
            ]);

            VolunteerEventApplication::create([
                'event_id' => $event->id,
                'full_name' => 'John Doe',
                'email' => 'john@gmail.com',
                'phone_number' => '(555) 456-7890',
                'application_reason' => 'I want to give back to the community and help make this event successful.',
                'status' => 'pending',
                'applied_at' => now(),
            ]);
        }
    }
}
