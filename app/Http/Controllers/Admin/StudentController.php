<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ScholarshipApplication;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ScholarshipApplicationStatusUpdate;

class StudentController extends Controller
{
    /**
     * Display a listing of the scholarship applications.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Only show pending applications in the Applicants section
        $applications = ScholarshipApplication::where('status', 'pending')->latest()->get();

        // Get approved applications to find corresponding students
        $approvedApplications = ScholarshipApplication::where('status', 'approved')->get();
        $approvedEmails = $approvedApplications->pluck('email')->toArray();

        // Only show students who have approved scholarship applications
        $students = User::where('role', 'student')
                       ->where('status', 'active')
                       ->whereIn('email', $approvedEmails)
                       ->latest()
                       ->get();

        // Get counts for display
        $pendingApplicationsCount = ScholarshipApplication::where('status', 'pending')->count();
        $approvedApplicationsCount = ScholarshipApplication::where('status', 'approved')->count();
        $activeStudentsCount = $students->count();

        return view('admin.students.index', compact('applications', 'students', 'pendingApplicationsCount', 'approvedApplicationsCount', 'activeStudentsCount'));
    }

    /**
     * Update application status to approved and create student account
     *
     * @param  string  $tracking_code
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve($tracking_code)
    {
        $application = ScholarshipApplication::where('tracking_code', $tracking_code)->firstOrFail();
        
        // Check if a user with this email already exists
        $user = User::where('email', $application->email)->first();

        if ($user) {
            // If user exists, update their role to 'student'
            $user->role = 'student';
            $user->status = 'active'; // Assuming active status upon approval
            $user->scholarship_type = $application->scholarship_type; // Update scholarship type for existing user
            $user->transcript_path = $application->transcript_path; // Copy transcript from application
            $user->save();
        } else {
            // If user does not exist, create a new student user
            $user = User::create([
                'name' => $application->full_name,
                'email' => $application->email,
                'password' => bcrypt(Str::random(10)), // Generate random password
                'role' => 'student',
                'status' => 'active',
                'phone_number' => $application->phone_number,
                'scholarship_type' => $application->scholarship_type,
                'transcript_path' => $application->transcript_path, // Copy transcript from application
            ]);
        }

        // Update application status
        $oldStatus = $application->status;
        $application->status = 'approved';
        $application->save();

        // Send status update email
        try {
            Mail::to($application->email)->send(new ScholarshipApplicationStatusUpdate($application));
            Log::info('Scholarship application approval email sent', [
                'application_id' => $application->id,
                'email' => $application->email,
                'old_status' => $oldStatus,
                'new_status' => 'approved',
                'tracking_code' => $application->tracking_code
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send scholarship application approval email: ' . $e->getMessage(), [
                'application_id' => $application->id,
                'email' => $application->email,
                'tracking_code' => $application->tracking_code
            ]);
        }

        return redirect()->route('admin.students.index.shortcut')->with('success', 'Application approved and student account created successfully');
    }

    /**
     * Update application status to rejected
     *
     * @param  string  $tracking_code
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reject($tracking_code)
    {
        $application = ScholarshipApplication::where('tracking_code', $tracking_code)->firstOrFail();
        $oldStatus = $application->status;
        $application->status = 'declined';
        $application->save();

        // Send status update email
        try {
            Mail::to($application->email)->send(new ScholarshipApplicationStatusUpdate($application));
            Log::info('Scholarship application rejection email sent', [
                'application_id' => $application->id,
                'email' => $application->email,
                'old_status' => $oldStatus,
                'new_status' => 'declined',
                'tracking_code' => $application->tracking_code
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send scholarship application rejection email: ' . $e->getMessage(), [
                'application_id' => $application->id,
                'email' => $application->email,
                'tracking_code' => $application->tracking_code
            ]);
        }

        return redirect()->back()->with('success', 'Application declined successfully');
    }

    /**
     * Remove the specified scholarship application.
     *
     * @param  string  $tracking_code
     */
    public function destroy($tracking_code)
    {
        $application = ScholarshipApplication::where('tracking_code', $tracking_code)->firstOrFail();
        $application->delete();
        return redirect()->back()->with('success', 'Application deleted successfully.');
    }

    /**
     * Delete a student user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyUser($id)
    {
        $user = User::where('role', 'student')->findOrFail($id);
        $user->delete();
        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully.');
    }
}
