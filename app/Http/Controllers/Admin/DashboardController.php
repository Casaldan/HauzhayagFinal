<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get basic statistics
        $totalUsers = User::count();
        $activeStudents = User::where('role', 'student')->count();
        $pendingApplicants = User::where('role', 'student')->where('status', 'pending')->count();
        $activeEvents = Event::where('status', 'active')
            ->orWhere(function($query) {
                $query->where('start_date', '<=', Carbon::now())
                      ->where('end_date', '>=', Carbon::now());
            })
            ->count();

        // Get recent events (last 5 events)
        $recentEvents = Event::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'activeStudents',
            'pendingApplicants',
            'activeEvents',
            'recentEvents'
        ));
    }
}
