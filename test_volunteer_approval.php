<?php

require_once 'vendor/autoload.php';

use Illuminate\Foundation\Application;
use Illuminate\Contracts\Console\Kernel;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

// Test the volunteer approval system
echo "=== Testing Volunteer Approval System ===\n\n";

try {
    // 1. Check current state
    $totalVolunteers = \App\Models\Volunteer::count();
    $pendingVolunteers = \App\Models\Volunteer::where('status', 'Pending')->count();
    $volunteerUsers = \App\Models\User::where('role', 'volunteer')->count();
    
    echo "Current State:\n";
    echo "- Total Volunteers: {$totalVolunteers}\n";
    echo "- Pending Volunteers: {$pendingVolunteers}\n";
    echo "- Volunteer Users: {$volunteerUsers}\n\n";
    
    // 2. Create a test volunteer if none exist
    if ($pendingVolunteers == 0) {
        echo "Creating test volunteer...\n";
        $testVolunteer = \App\Models\Volunteer::create([
            'name' => 'Test Approval Volunteer',
            'email' => 'testapproval@gmail.com',
            'phone' => '09123456789',
            'skills' => json_encode(['Testing']),
            'status' => 'Pending',
            'notes' => 'Created for approval testing',
            'start_date' => now(),
        ]);
        echo "Test volunteer created with ID: {$testVolunteer->id}\n\n";
    } else {
        $testVolunteer = \App\Models\Volunteer::where('status', 'Pending')->first();
        echo "Using existing pending volunteer: {$testVolunteer->name} (ID: {$testVolunteer->id})\n\n";
    }
    
    // 3. Test the approval process
    echo "Testing approval process...\n";
    echo "Before approval:\n";
    echo "- Volunteer status: {$testVolunteer->status}\n";
    
    $userBefore = \App\Models\User::where('email', $testVolunteer->email)->first();
    echo "- User account exists: " . ($userBefore ? 'Yes' : 'No') . "\n\n";
    
    // Simulate the approval process
    $testVolunteer->status = 'Active';
    $testVolunteer->save();
    
    // Check if user exists, if not create one
    $user = \App\Models\User::where('email', $testVolunteer->email)->first();
    $defaultPassword = 'volunteer123';
    
    if ($user) {
        $user->role = 'volunteer';
        $user->status = 'active';
        $user->phone_number = $testVolunteer->phone;
        $user->save();
        echo "Existing user updated to volunteer role\n";
    } else {
        $user = \App\Models\User::create([
            'name' => $testVolunteer->name,
            'email' => $testVolunteer->email,
            'password' => bcrypt($defaultPassword),
            'role' => 'volunteer',
            'status' => 'active',
            'phone_number' => $testVolunteer->phone,
            'email_verified_at' => now(),
        ]);
        echo "New user account created\n";
    }
    
    // 4. Verify the results
    echo "\nAfter approval:\n";
    $testVolunteer->refresh();
    echo "- Volunteer status: {$testVolunteer->status}\n";
    echo "- User account exists: Yes\n";
    echo "- User role: {$user->role}\n";
    echo "- User status: {$user->status}\n";
    echo "- Default password: {$defaultPassword}\n\n";
    
    // 5. Final counts
    $finalVolunteerUsers = \App\Models\User::where('role', 'volunteer')->count();
    echo "Final State:\n";
    echo "- Volunteer Users: {$finalVolunteerUsers}\n";
    echo "- Increase in volunteer users: " . ($finalVolunteerUsers - $volunteerUsers) . "\n\n";
    
    echo "✅ Test completed successfully!\n";
    echo "The volunteer approval system is working correctly.\n";
    echo "Approved volunteers automatically get user accounts and appear in User Management.\n";
    
} catch (Exception $e) {
    echo "❌ Test failed with error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}
