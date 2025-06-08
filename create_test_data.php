<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\VolunteerEventApplication;
use App\Models\Event;

// Get the first event
$event = Event::first();

if ($event) {
    echo "Creating test volunteer event applications...\n";
    
    // Create test applications
    VolunteerEventApplication::create([
        'event_id' => $event->id,
        'full_name' => 'Lito Milabo',
        'email' => 'lito@gmail.com',
        'application_reason' => 'I want to help with the Christmas party and contribute to the community.',
        'status' => 'pending',
        'applied_at' => now(),
    ]);

    VolunteerEventApplication::create([
        'event_id' => $event->id,
        'full_name' => 'Maria Santos',
        'email' => 'maria@gmail.com',
        'application_reason' => 'I have experience in event management and would love to volunteer.',
        'status' => 'pending',
        'applied_at' => now(),
    ]);

    VolunteerEventApplication::create([
        'event_id' => $event->id,
        'full_name' => 'John Doe',
        'email' => 'john@gmail.com',
        'application_reason' => 'I want to give back to the community and help make this event successful.',
        'status' => 'pending',
        'applied_at' => now(),
    ]);

    echo "Created " . VolunteerEventApplication::count() . " volunteer event applications.\n";
} else {
    echo "No events found. Please create an event first.\n";
}
