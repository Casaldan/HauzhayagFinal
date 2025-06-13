<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Volunteer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class SyncVolunteersToUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'volunteers:sync-to-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync existing volunteers to the users table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to sync volunteers to users table...');

        // Get all active volunteers
        $volunteers = Volunteer::where('status', 'Active')->get();
        
        $synced = 0;
        $skipped = 0;

        foreach ($volunteers as $volunteer) {
            // Check if user already exists
            $existingUser = User::where('email', $volunteer->email)->first();

            if (!$existingUser) {
                try {
                    $newUser = User::create([
                        'name' => $volunteer->name,
                        'email' => $volunteer->email,
                        'password' => Hash::make('volunteer123'), // Default password
                        'role' => 'volunteer',
                        'status' => 'active',
                        'phone_number' => $volunteer->phone,
                        'email_verified_at' => now(),
                    ]);

                    $this->info("Created user for volunteer: {$volunteer->name} ({$volunteer->email})");
                    $synced++;

                    // Log the sync
                    Log::info('Volunteer synced to users table', [
                        'volunteer_id' => $volunteer->id,
                        'user_id' => $newUser->id,
                        'email' => $volunteer->email
                    ]);

                } catch (\Exception $e) {
                    $this->error("Failed to create user for volunteer {$volunteer->name}: " . $e->getMessage());
                    Log::error('Failed to sync volunteer to users table', [
                        'volunteer_id' => $volunteer->id,
                        'email' => $volunteer->email,
                        'error' => $e->getMessage()
                    ]);
                }
            } else {
                $this->line("User already exists for volunteer: {$volunteer->name} ({$volunteer->email})");
                $skipped++;
            }
        }

        $this->info("Sync completed!");
        $this->info("Users created: {$synced}");
        $this->info("Users skipped (already exist): {$skipped}");
        $this->info("Total volunteers processed: " . ($synced + $skipped));

        return Command::SUCCESS;
    }
}
