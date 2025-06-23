<?php

namespace App\Http\Controllers;

use App\Models\ScholarshipApplication;
use App\Models\User; // Import User model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail; // If sending email
use Illuminate\Support\Str; // For random strings
use Illuminate\Support\Facades\Hash; // For hashing password
use App\Mail\TrackingCodeMail; // Make sure Mailable is imported
use App\Mail\ScholarshipApplicationStatusUpdate; // Import the new mailable
use Illuminate\Support\Facades\Log; // For logging errors
use Carbon\Carbon;

class ScholarshipController extends Controller
{
    /**
     * Store a newly created scholarship application in storage.
     * Also creates a user record if one doesn't exist.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function apply(Request $request)
    {
        // 1. Validate the incoming request data
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255'],
            'phone_number' => ['nullable', 'string', 'regex:/^\d{11}$/'],
            'scholarship_type' => 'required|string|in:community_based,in_house',
            'transcript' => 'required|file|mimes:jpg,jpeg,png|max:5120', // Max 5MB example
            'terms' => 'required|accepted', // Terms and conditions must be accepted
        ], [
            'email.regex' => 'Email must be a valid email address (must contain @gmail).',
            'phone_number.regex' => 'Phone number must be exactly 11 digits.',
            'terms.required' => 'You must agree to the Terms and Conditions.',
            'terms.accepted' => 'You must agree to the Terms and Conditions.'
        ]);

        // 2. Handle File Upload
        $transcriptPath = null;
        if ($request->hasFile('transcript')) {
            // Store in 'public/transcripts' folder. Ensure storage link exists (`php artisan storage:link`)
            $transcriptPath = $request->file('transcript')->store('transcripts', 'public');
        }

        // 3. Generate Unique Tracking Code: current year + 4-digit random number
        $yearPrefix = Carbon::now()->format('Y');
        do {
            $trackingCode = $yearPrefix . str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
        } while (ScholarshipApplication::where('tracking_code', $trackingCode)->exists());

        // 4. Save the Scholarship Application
        $application = ScholarshipApplication::create([
            'full_name' => $validatedData['full_name'],
            'email' => $validatedData['email'],
            'phone_number' => $validatedData['phone_number'],
            'scholarship_type' => $validatedData['scholarship_type'], // Use actual scholarship type from form
            'transcript_path' => $transcriptPath,
            'tracking_code' => $trackingCode,
            'status' => 'pending', // Default status
        ]);

        // 5. Create User Record if not exists
        $existingUser = User::where('email', $validatedData['email'])->first();

        if (!$existingUser) {
            User::create([
                'name' => $validatedData['full_name'],
                'email' => $validatedData['email'],
                'password' => Hash::make(Str::random(10)), // Generate random password
                'role' => 'student', // Set role to student
                'class_year' => Carbon::now()->format('Y'), // Add current year as class year
                'status' => 'active', // Add status field
                'phone_number' => $validatedData['phone_number'], // Add phone_number
                'scholarship_type' => $validatedData['scholarship_type'], // Use actual scholarship type from form
            ]);
        }

        // Send Email Notification
        try {
            Mail::to($validatedData['email'])
                ->send(new TrackingCodeMail($application));
            
            // Log successful email sending
            Log::info('Tracking code email sent successfully', [
                'email' => $validatedData['email'],
                'tracking_code' => $trackingCode
            ]);
        } catch (\Exception $e) {
            // Log the error but don't stop the application process
            Log::error('Failed to send tracking code email: ' . $e->getMessage(), [
                'email' => $validatedData['email'],
                'tracking_code' => $trackingCode,
                'error' => $e->getMessage()
            ]);
        }

        // Redirect to a success page with the tracking code
        return redirect()->route('scholarship.success', ['tracking_code' => $trackingCode]);
    }

    public function track(Request $request)
    {
        // For GET requests from links
        if ($request->isMethod('get') && $request->has('tracking_code')) {
            $tracking_code = $request->tracking_code;
        } else {
            // For POST requests from forms
            $request->validate([
                'tracking_code' => 'required|string|size:8'
            ]);
            $tracking_code = $request->tracking_code;
        }

        $application = ScholarshipApplication::where('tracking_code', $tracking_code)->first();

        if ($application) {
            return redirect()->route('scholarship.show', ['tracking_code' => $application->tracking_code]);
        }

        return back()->with('error', 'Invalid tracking code. Please check and try again.');
    }

    public function show($tracking_code)
    {
        $application = ScholarshipApplication::where('tracking_code', $tracking_code)->firstOrFail();
        return view('scholarship.track_status', compact('application'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,declined'
        ]);

        $application = ScholarshipApplication::findOrFail($id);
        $oldStatus = $application->status;
        $application->status = $request->status;
        $application->save();

        // If status is changed to approved, create or update user account
        if ($request->status === 'approved' && $oldStatus !== 'approved') {
            $user = User::where('email', $application->email)->first();

            if ($user) {
                // If user exists, update their role to 'student'
                $user->role = 'student';
                $user->status = 'active';
                $user->scholarship_type = $application->scholarship_type ?? 'general';
                $user->transcript_path = $application->transcript_path;
                $user->save();
            } else {
                // If user does not exist, create a new student user
                User::create([
                    'name' => $application->full_name,
                    'email' => $application->email,
                    'password' => Hash::make(Str::random(10)), // Generate random password
                    'role' => 'student',
                    'status' => 'active',
                    'phone_number' => $application->phone_number,
                    'scholarship_type' => $application->scholarship_type ?? 'general',
                    'transcript_path' => $application->transcript_path,
                ]);
            }
        }

        // Send status update email if status changed
        if ($oldStatus !== $request->status) {
            try {
                Mail::to($application->email)->send(new ScholarshipApplicationStatusUpdate($application));
                Log::info('Scholarship application status update email sent', [
                    'application_id' => $application->id,
                    'email' => $application->email,
                    'old_status' => $oldStatus,
                    'new_status' => $request->status,
                    'tracking_code' => $application->tracking_code
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to send scholarship application status update email: ' . $e->getMessage(), [
                    'application_id' => $application->id,
                    'email' => $application->email,
                    'status' => $request->status,
                    'tracking_code' => $application->tracking_code
                ]);
            }
        }

        return response()->json([
            'message' => 'Application status updated successfully',
            'status' => $application->status
        ]);
    }

    public function index()
    {
        $applications = ScholarshipApplication::latest()->get();
        return view('admin.applications.index', compact('applications'));
    }

    public function showApplyForm()
    {
        // Return the view containing the application form
        return view('scholarship.apply');
    }

    /**
     * Display the success page after application submission
     */
    public function success($tracking_code)
    {
        // Check if the tracking code exists
        $application = ScholarshipApplication::where('tracking_code', $tracking_code)->first();
        
        if (!$application) {
            return redirect()->route('home')->with('error', 'Invalid tracking code.');
        }
        
        return view('scholarship.success', compact('tracking_code'));
    }

    /**
     * Resend the tracking code to the user's email address.
     */
    public function resendCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $application = ScholarshipApplication::where('email', $request->email)->first();

        if (!$application) {
            return back()->with('error', 'No application found for this email address.');
        }

        try {
            Mail::to($application->email)->send(new TrackingCodeMail($application));
            Log::info('Tracking code resent successfully', [
                'email' => $application->email,
                'tracking_code' => $application->tracking_code
            ]);
            return back()->with('success', 'Tracking code has been resent to your email address.');
        } catch (\Exception $e) {
            Log::error('Failed to resend tracking code: ' . $e->getMessage(), [
                'email' => $application->email,
                'tracking_code' => $application->tracking_code,
                'error' => $e->getMessage()
            ]);
            return back()->with('error', 'Failed to resend tracking code. Please try again later.');
        }
    }
}