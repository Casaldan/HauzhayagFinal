<?php

// Simple test script to create a volunteer event application
// Run this with: php test_volunteer_application.php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Event;
use App\Models\VolunteerEventApplication;

try {
    // Get the first available event
    $event = Event::first();
    
    if (!$event) {
        echo "No events found. Please create an event first.\n";
        exit;
    }
    
    // Create a test volunteer event application
    $application = VolunteerEventApplication::create([
        'event_id' => $event->id,
        'full_name' => 'John Test Volunteer',
        'email' => 'john.volunteer@test.com',
        'phone_number' => '09123456789',
        'application_reason' => 'I am passionate about helping the community and would love to contribute to this event. I have experience in event management and volunteer work.',
        'status' => 'pending'
    ]);
    
    echo "Test volunteer event application created successfully!\n";
    echo "Application ID: " . $application->id . "\n";
    echo "Event: " . $event->title . "\n";
    echo "Applicant: " . $application->full_name . "\n";
    echo "Status: " . $application->status . "\n";
    echo "\nYou can now test the approval workflow in the admin panel.\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
