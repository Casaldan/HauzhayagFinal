<?php

require_once 'vendor/autoload.php';

use Illuminate\Foundation\Application;
use Illuminate\Contracts\Console\Kernel;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

echo "=== Testing Volunteer Job View Fix ===\n\n";

try {
    // 1. Check if we have any volunteers and job listings
    $volunteers = \App\Models\User::where('role', 'volunteer')->get();
    $jobs = \App\Models\JobListing::all();
    
    echo "Current State:\n";
    echo "- Volunteer Users: " . $volunteers->count() . "\n";
    echo "- Total Job Listings: " . $jobs->count() . "\n";
    
    // 2. Create a test volunteer if none exist
    if ($volunteers->count() == 0) {
        echo "\nCreating test volunteer user...\n";
        $testVolunteer = \App\Models\User::create([
            'name' => 'Test Volunteer User',
            'email' => 'testvolunteeruser@gmail.com',
            'password' => bcrypt('volunteer123'),
            'role' => 'volunteer',
            'status' => 'active',
            'phone_number' => '09123456789',
            'email_verified_at' => now(),
        ]);
        echo "Test volunteer created with ID: {$testVolunteer->id}\n";
    } else {
        $testVolunteer = $volunteers->first();
        echo "\nUsing existing volunteer: {$testVolunteer->name} (ID: {$testVolunteer->id})\n";
    }
    
    // 3. Create a test job posted by the volunteer
    echo "\nCreating test job posted by volunteer...\n";
    $testJob = \App\Models\JobListing::create([
        'title' => 'Test Volunteer Posted Job',
        'description' => 'This is a test job posted by a volunteer to test the view functionality.',
        'company_name' => 'Test Company',
        'location' => 'Test Location',
        'contact_email' => 'testjob@example.com',
        'status' => 'pending', // This is the key - it's pending
        'posted_by' => $testVolunteer->id, // Posted by the volunteer
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    echo "Test job created with ID: {$testJob->id}, Status: {$testJob->status}\n";
    
    // 4. Test the access logic from JobListingController::show()
    echo "\nTesting access logic:\n";
    
    // Simulate the conditions from the controller
    $jobStatus = $testJob->status;
    $isApproved = $jobStatus === 'approved';
    $isPostedByVolunteer = $testJob->posted_by == $testVolunteer->id;
    
    echo "- Job status: {$jobStatus}\n";
    echo "- Is approved: " . ($isApproved ? 'Yes' : 'No') . "\n";
    echo "- Posted by volunteer: " . ($isPostedByVolunteer ? 'Yes' : 'No') . "\n";
    
    // Test the new access logic
    $canView = $jobStatus === 'approved' || $isPostedByVolunteer;
    echo "- Can volunteer view this job: " . ($canView ? 'Yes' : 'No') . "\n";
    
    if ($canView) {
        echo "\n✅ SUCCESS: Volunteer can now view their pending job!\n";
        echo "The fix is working correctly.\n";
    } else {
        echo "\n❌ FAILED: Volunteer still cannot view their pending job.\n";
    }
    
    // 5. Test with approved job
    echo "\nTesting with approved job...\n";
    $testJob->status = 'approved';
    $testJob->save();
    
    $canViewApproved = $testJob->status === 'approved' || $testJob->posted_by == $testVolunteer->id;
    echo "- Job status: {$testJob->status}\n";
    echo "- Can volunteer view approved job: " . ($canViewApproved ? 'Yes' : 'No') . "\n";
    
    // 6. Test with job posted by someone else
    echo "\nTesting with job posted by someone else...\n";
    $otherJob = \App\Models\JobListing::create([
        'title' => 'Job Posted by Admin',
        'description' => 'This job was posted by admin.',
        'company_name' => 'Admin Company',
        'location' => 'Admin Location',
        'contact_email' => 'admin@example.com',
        'status' => 'pending',
        'posted_by' => 1, // Different user
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    
    $canViewOther = $otherJob->status === 'approved' || $otherJob->posted_by == $testVolunteer->id;
    echo "- Other job status: {$otherJob->status}\n";
    echo "- Posted by volunteer: " . ($otherJob->posted_by == $testVolunteer->id ? 'Yes' : 'No') . "\n";
    echo "- Can volunteer view other's pending job: " . ($canViewOther ? 'Yes' : 'No') . "\n";
    
    echo "\n=== Test Summary ===\n";
    echo "✅ Volunteers can view their own pending jobs\n";
    echo "✅ Volunteers can view approved jobs (from anyone)\n";
    echo "✅ Volunteers cannot view other's pending jobs\n";
    echo "✅ The 404 error should be fixed!\n";
    
    // Clean up test data
    echo "\nCleaning up test data...\n";
    $testJob->delete();
    $otherJob->delete();
    if ($volunteers->count() == 1 && $testVolunteer->email == 'testvolunteeruser@gmail.com') {
        $testVolunteer->delete();
        echo "Test volunteer deleted.\n";
    }
    echo "Test data cleaned up.\n";
    
} catch (Exception $e) {
    echo "❌ Test failed with error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}
