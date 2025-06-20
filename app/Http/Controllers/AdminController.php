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
        $query = Volunteer::query();

        // Filter by status if specified
        if (request('status') && request('status') !== '') {
            $query->where('status', request('status'));
        }

        // Search functionality
        if (request('search') && request('search') !== '') {
            $query->where(function($q) {
                $search = request('search');
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $volunteers = $query->latest()->paginate(10);
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
        $volunteer->status = 'Active'; // Use 'Active' to match the enum in migration
        $volunteer->save();

        // Check if a user with this email already exists
        $user = \App\Models\User::where('email', $volunteer->email)->first();
        $defaultPassword = 'volunteer123'; // Default password for new volunteers
        $isNewUser = false;

        if ($user) {
            // If user exists, update their role to 'volunteer' and ensure they're active
            $user->role = 'volunteer';
            $user->status = 'active';
            $user->phone_number = $volunteer->phone; // Update phone number
            $user->save();
            $message = 'Volunteer approved successfully and existing user account updated. They can now be managed in User Management.';
        } else {
            // If user does not exist, create a new volunteer user with default password
            $user = \App\Models\User::create([
                'name' => $volunteer->name,
                'email' => $volunteer->email,
                'password' => bcrypt($defaultPassword), // Use default password for easier management
                'role' => 'volunteer',
                'status' => 'active',
                'phone_number' => $volunteer->phone,
                'email_verified_at' => now(),
            ]);
            $isNewUser = true;
            $message = "Volunteer approved successfully and user account created with default password '{$defaultPassword}'. They can now be managed in User Management where you can change their password.";
        }

        // Log the user creation/update for debugging
        \Log::info('User account created/updated from volunteer approval', [
            'user_id' => $user->id,
            'volunteer_id' => $volunteer->id,
            'email' => $volunteer->email,
            'role' => 'volunteer',
            'status' => 'active',
            'action' => $isNewUser ? 'created' : 'updated',
            'default_password_used' => $isNewUser
        ]);

        return back()->with('success', $message);
    }

    public function rejectVolunteer(Volunteer $volunteer)
    {
        $volunteer->status = 'Inactive'; // Use 'Inactive' instead of 'Rejected' to match enum
        $volunteer->save();
        return back()->with('success', 'Volunteer application rejected successfully.');
    }



    public function editVolunteer(Volunteer $volunteer)
    {
        return view('admin.volunteers.edit', compact('volunteer'));
    }

    public function updateVolunteer(Request $request, Volunteer $volunteer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:volunteers,email,' . $volunteer->id,
            'phone' => 'required|string|max:20',
            'skills' => 'nullable|string',
            'status' => 'required|in:Active,Pending,Inactive',
            'notes' => 'nullable|string',
            'start_date' => 'required|date',
        ]);

        // Handle skills as JSON if it's an array
        if (is_array($validated['skills'])) {
            $validated['skills'] = json_encode($validated['skills']);
        }

        $volunteer->update($validated);

        return redirect()->route('admin.volunteers.index')
            ->with('success', 'Volunteer updated successfully.');
    }

    public function destroyVolunteer(Volunteer $volunteer)
    {
        try {
            $volunteerName = $volunteer->name;
            $volunteer->delete();

            return redirect()->route('admin.volunteers.index')
                ->with('success', "Volunteer '{$volunteerName}' has been deleted successfully.");
        } catch (\Exception $e) {
            return redirect()->route('admin.volunteers.index')
                ->with('error', 'Failed to delete volunteer. Please try again.');
        }
    }

    private function updateCompletedEvents()
    {
        // Update status of completed events
        Event::where('end_date', '<', Carbon::now())
             ->where('status', '!=', 'completed')
             ->update(['status' => 'completed']);
    }
}