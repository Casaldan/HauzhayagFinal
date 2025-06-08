<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\JobListing;
use Carbon\Carbon;

class RemoveExpiredJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jobs:remove-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove expired job listings from the website';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();

        $expiredJobs = JobListing::where('expiry_date', '<', $today)
            ->where('status', 'approved')
            ->get();

        if ($expiredJobs->count() > 0) {
            foreach ($expiredJobs as $job) {
                $job->update(['status' => 'expired']);
            }

            $this->info("Removed {$expiredJobs->count()} expired job(s) from the website.");
        } else {
            $this->info('No expired jobs found.');
        }
    }
}
