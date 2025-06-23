<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\TrackingCodeMail;
use App\Models\ScholarshipApplication;

class TestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:test {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test email functionality by sending a test email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email') ?? 'hauzhayag15@gmail.com';

        $this->info("Testing email functionality...");
        $this->info("Sending test email to: {$email}");

        try {
            // Create a test scholarship application
            $testApplication = new ScholarshipApplication([
                'full_name' => 'Test Student',
                'email' => $email,
                'tracking_code' => 'TEST' . rand(100000, 999999),
                'status' => 'pending'
            ]);

            // Send the email
            Mail::to($email)->send(new TrackingCodeMail($testApplication));

            $this->info("✅ Email sent successfully!");
            $this->info("Check the inbox for: {$email}");

        } catch (\Exception $e) {
            $this->error("❌ Email failed to send!");
            $this->error("Error: " . $e->getMessage());

            // Check common issues
            $this->warn("\nCommon issues to check:");
            $this->warn("1. MAIL_PASSWORD should be an App Password (not your regular Gmail password)");
            $this->warn("2. 2-Factor Authentication should be enabled on Gmail");
            $this->warn("3. Check your .env file configuration");
            $this->warn("4. Make sure 'Less secure app access' is disabled (use App Passwords instead)");
        }
    }
}
