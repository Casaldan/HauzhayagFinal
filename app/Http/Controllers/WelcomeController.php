<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\JobListing;

class WelcomeController extends Controller
{
    public function index()
    {
        // Get only approved and admin-posted upcoming events for the welcome page
        $events = Event::where('status', 'active')
            ->where('is_admin_posted', true)
            ->where('start_date', '>', Carbon::now())
            ->orderBy('start_date', 'asc')
            ->take(6)
            ->get();

        // Get ALL approved jobs (both admin and volunteer posted) for display on homepage
        $jobs = JobListing::where('status', 'approved')
            ->where(function($query) {
                $query->whereNull('expires_at')
                      ->orWhere('expires_at', '>', now());
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('welcome', compact('events', 'jobs'));
    }
}


