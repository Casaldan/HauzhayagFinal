<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Event;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Volunteer;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            if (!$user->is_admin) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'You do not have admin privileges.',
                ]);
            }

            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function index()
    {
        // Auto-update completed events
        $this->updateCompletedEvents();

        // Get counts for dashboard
        $data = [
            'totalUsers' => User::count(),
            'totalEvents' => Event::where('status', '!=', 'completed')->count(),
            'upcomingEvents' => Event::where('start_date', '>', Carbon::now())
                                   ->where('status', '!=', 'completed')
                                   ->orderBy('start_date', 'asc')
                                   ->take(5)
                                   ->get(),
            'completedEvents' => Event::where('status', 'completed')
                                    ->orderBy('end_date', 'desc')
                                    ->take(5)
                                    ->get(),
            'recentEvents' => Event::orderBy('created_at', 'desc')
                                 ->take(5)
                                 ->get(),
            'activeStudents' => User::where('role', 'student')
                                  ->where('status', 'active')
                                  ->count(),
            'pendingApplicants' => User::where('role', 'applicant')
                                    ->where('status', 'pending')
                                    ->count(),
            'activeEvents' => Event::where('status', '!=', 'completed')
                                 ->where('status', '!=', 'cancelled')
                                 ->count()
        ];

        return view('admin.dashboard', $data);
    }

    public function volunteerIndex()
    {
        $volunteers = Volunteer::latest()->paginate(10);
        $totalVolunteersCount = Volunteer::count();
        $activeVolunteersCount = Volunteer::where('status', 'Active')->count();
        $inactiveVolunteersCount = Volunteer::where('status', 'Inactive')->count();
        $pendingVolunteersCount = Volunteer::where('status', 'Pending')->count();

        // Get volunteer event applications
        $volunteerEventApplications = \App\Models\VolunteerEventApplication::with('event')
            ->latest()
            ->get();

        $pendingEventApplicationsCount = $volunteerEventApplications->where('status', 'pending')->count();

        // Add pending event applications to the pending volunteers count
        $totalPendingCount = $pendingVolunteersCount + $pendingEventApplicationsCount;

        // Calculate hours served (mock data for now)
        $hoursServed = 432; // You can calculate this from actual volunteer hours

        // Get upcoming events count
        $upcomingEventsCount = \App\Models\Event::where('start_date', '>', now())->count();

        return view('admin.volunteers.index', compact(
            'volunteers',
            'totalVolunteersCount',
            'activeVolunteersCount',
            'inactiveVolunteersCount',
            'pendingVolunteersCount',
            'totalPendingCount',
            'volunteerEventApplications',
            'pendingEventApplicationsCount',
            'hoursServed',
            'upcomingEventsCount'
        ));
    }

    public function getVolunteerEventApplications()
    {
        $applications = \App\Models\VolunteerEventApplication::with('event')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($applications);
    }

    public function approveVolunteer(Volunteer $volunteer)
    {
        $volunteer->status = 'Approved';
        $volunteer->save();
        return back()->with('success', 'Volunteer application approved successfully.');
    }

    public function rejectVolunteer(Volunteer $volunteer)
    {
        $volunteer->status = 'Rejected';
        $volunteer->save();
        return back()->with('success', 'Volunteer application rejected successfully.');
    }

    private function updateCompletedEvents()
    {
        // Update status of completed events
        Event::where('end_date', '<', Carbon::now())
             ->where('status', '!=', 'completed')
             ->update(['status' => 'completed']);
    }
}