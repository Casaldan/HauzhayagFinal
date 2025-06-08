<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\VolunteerEventApplication;
use App\Models\Event;

echo "Setting up phone number field...\n";

// Check if phone_number column exists
if (!Schema::hasColumn('volunteer_event_applications', 'phone_number')) {
    echo "Adding phone_number column to volunteer_event_applications table...\n";
    
    Schema::table('volunteer_event_applications', function (Blueprint $table) {
        $table->string('phone_number')->after('email')->nullable();
    });
    
    echo "Phone number column added successfully!\n";
} else {
    echo "Phone number column already exists.\n";
}

// Create test data if no applications exist
$count = VolunteerEventApplication::count();
echo "Current volunteer event applications count: $count\n";

if ($count == 0) {
    echo "Creating test volunteer event applications...\n";
    
    $event = Event::first();
    
    if ($event) {
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

        echo "Created " . VolunteerEventApplication::count() . " test applications.\n";
    } else {
        echo "No events found. Please create an event first.\n";
    }
} else {
    echo "Test data already exists.\n";
}

echo "Setup completed!\n";
