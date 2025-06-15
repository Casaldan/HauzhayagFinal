<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // Debug: Log the request parameters
        \Log::info('User index filters', [
            'role' => request('role'),
            'class_year' => request('class_year'),
            'search' => request('search'),
            'status' => request('status'),
            'all_params' => request()->all()
        ]);

        $query = User::query();

        // Filter by role if specified
        if (request('role') && request('role') !== '') {
            $query->where('role', request('role'));
            \Log::info('Applied role filter: ' . request('role'));
        }

        // Filter by class year if specified
        if (request('class_year') && request('class_year') !== '') {
            $query->where('class_year', request('class_year'));
            \Log::info('Applied class_year filter: ' . request('class_year'));
        }

        // Search functionality
        if (request('search') && request('search') !== '') {
            $query->where(function($q) {
                $search = request('search');
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
            \Log::info('Applied search filter: ' . request('search'));
        }

        // Status filter
        if (request('status') && request('status') !== '') {
            $query->where('status', request('status'));
            \Log::info('Applied status filter: ' . request('status'));
        }

        $users = $query->latest()->paginate(10);

        \Log::info('Query result count: ' . $users->count());
        
        return view('admin.users.index', [
            'users' => $users,
            'currentRole' => request('role', 'all'),
            'currentStatus' => request('status', 'all'),
            'currentClassYear' => request('class_year', 'all')
        ]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'regex:/@gmail\./i'],
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,student,volunteer',  // Updated roles
            'status' => 'required|string|in:active,inactive',
            'class_year' => 'nullable|string',  // Add class_year validation
            'profile_picture' => 'nullable|image|max:1024',
            'phone_number' => ['nullable', 'string', 'regex:/^\d{11}$/'], // Add phone_number validation
            'scholarship_type' => 'nullable|string|in:home_based,in_house', // Add scholarship_type validation
        ], [
            'email.regex' => 'Email must be a Gmail address (must contain @gmail).',
            'phone_number.regex' => 'Phone number must be exactly 11 digits.'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->status = $request->status;
        $user->class_year = $request->class_year;  // Add class_year
        $user->phone_number = $request->phone_number; // Add phone_number
        $user->scholarship_type = $request->scholarship_type; // Add scholarship_type

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile-pictures', 'public');
            $user->profile_picture = $path;
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Log the request for debugging
        \Log::info('User update request received', [
            'user_id' => $user->id,
            'request_data' => $request->all()
        ]);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id, 'regex:/@gmail\./i'],
            'role' => 'required|in:admin,student,volunteer',
            'status' => 'required|in:active,inactive',
            'class_year' => 'nullable|string',
            'password' => 'nullable|string|min:8',
            'phone_number' => ['nullable', 'string', 'regex:/^\d{11}$/'],
            'scholarship_type' => 'nullable|string|in:home_based,in_house',
        ], [
            'email.regex' => 'Email must be a Gmail address (must contain @gmail).',
            'phone_number.regex' => 'Phone number must be exactly 11 digits.'
        ]);

        // Handle password update - only hash if password is provided and not empty
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            // Remove password from validated data if it's empty
            unset($validated['password']);
        }

        try {
            $user->update($validated);

            return redirect()->route('users.index')
                ->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to update user: ' . $e->getMessage()]);
        }
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}