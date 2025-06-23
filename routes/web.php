<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\VolunteerController;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationReceived;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\JobListingController;





//login Routes

// Admin login routes
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');

// Admin Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/applications', [ScholarshipController::class, 'index'])->name('admin.applications.index');
    Route::post('/applications/{id}/status', [ScholarshipController::class, 'updateStatus'])->name('admin.applications.updateStatus');
    Route::get('/scholars', [AdminController::class, 'showScholars'])->name('admin.scholars');
    Route::get('/settings', [AdminController::class, 'showSettings'])->name('admin.settings');
    Route::put('/settings', [AdminController::class, 'updateSettings'])->name('admin.settings.update');
    // Job approval/rejection routes (moved to admin prefix group below)

    // Admin Volunteer Management Routes (moved to admin prefix group below)



    // Volunteer application tracking
    Route::get('/volunteer/success', [\App\Http\Controllers\VolunteerApplicationController::class, 'showSuccess'])->name('volunteer.success');
    Route::get('/volunteer/track', [\App\Http\Controllers\VolunteerApplicationController::class, 'showTrackForm'])->name('volunteer.track');
    Route::post('/volunteer/track', [\App\Http\Controllers\VolunteerApplicationController::class, 'track'])->name('volunteer.track.submit');
});

// Scholarship Routes
Route::group(['prefix' => 'scholarship'], function () {
    Route::get('/apply', [ScholarshipController::class, 'showApplyForm'])->name('scholarship.apply.form');
    Route::post('/apply', [ScholarshipController::class, 'apply'])->name('scholarship.apply');
    Route::get('/status/{tracking_code}', [ScholarshipController::class, 'show'])->name('scholarship.show');
    Route::match(['get', 'post'], '/track', [ScholarshipController::class, 'track'])->name('scholarship.track');
    // Resend tracking code by email
    Route::post('/resend', [ScholarshipController::class, 'resendCode'])->name('scholarship.resend');
    Route::get('/scholarship/success/{tracking_code}', function ($tracking_code) {
        return view('scholarship.success', compact('tracking_code'));
    })->name('scholarship.success');
});

// Authentication routes
Auth::routes();
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Student routes
Route::middleware(['auth', \App\Http\Middleware\RedirectIfNotStudent::class])->prefix('student')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Student\DashboardController::class, 'index'])->name('student.dashboard');
    Route::get('/events', [App\Http\Controllers\Student\DashboardController::class, 'eventsIndex'])->name('student.events.index');
    Route::get('/jobs', [App\Http\Controllers\Student\DashboardController::class, 'jobsIndex'])->name('student.jobs.index');
    Route::get('/jobs/{job}', [App\Http\Controllers\Student\DashboardController::class, 'showJob'])->name('student.jobs.show');
});

// Other routes...

// Dashboard and User Management routes without auth
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Public Volunteer Dashboard Route (no auth required)
Route::get('/volunteer_dashboard', [VolunteerController::class, 'dashboard'])->name('volunteer.dashboard');

// User management routes with auth
Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

// Event routes with auth
Route::middleware(['auth'])->group(function () {
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/json', [EventController::class, 'getEventsJson'])->name('events.json');
    Route::get('/events/upcoming', [EventController::class, 'getUpcomingEvents'])->name('events.upcoming');
    Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
});

// Volunteer routes with auth (moved outside the main authenticated group)
Route::middleware(['auth'])->group(function () {
    Route::post('/volunteers', [VolunteerController::class, 'store'])->name('volunteers.store');
    Route::get('/volunteers/calendar', [VolunteerController::class, 'viewCalendar'])->name('volunteer.calendar');
    Route::post('/volunteers/job-offers', [VolunteerController::class, 'addJobOffer'])->name('volunteer.addJobOffer');
    Route::post('/volunteers/{volunteer}/status', [VolunteerController::class, 'updateStatus'])->name('volunteers.updateStatus');
    
    // New routes for volunteer dashboard and job post
    Route::get('/volunteer/dashboard', [VolunteerController::class, 'dashboard'])->name('volunteer.dashboard');
    Route::get('/volunteer/jobs', [VolunteerController::class, 'jobs'])->name('volunteer.jobs');
    Route::get('/volunteer/calendar', [VolunteerController::class, 'viewCalendar'])->name('volunteer.calendar');
    Route::get('/volunteer/events', [VolunteerController::class, 'events'])->name('volunteer.events');
    Route::get('/volunteer/events/{id}', [VolunteerController::class, 'showEvent'])->name('volunteer.events.show');
    Route::get('/volunteer/events/{event}/apply', [VolunteerController::class, 'showApplicationForm'])->name('volunteer.events.apply');
    Route::post('/volunteer/events/apply', [\App\Http\Controllers\VolunteerEventApplicationController::class, 'store'])->name('volunteer.events.apply.store');
    Route::post('/volunteer/events/apply-auto', [\App\Http\Controllers\VolunteerEventApplicationController::class, 'storeAuto'])->name('volunteer.events.apply.auto');

    // Volunteer job posting routes
    Route::get('/volunteer/jobs/create', [\App\Http\Controllers\JobListingController::class, 'create'])->name('volunteer.jobs.create');
    Route::post('/volunteer/jobs', [\App\Http\Controllers\JobListingController::class, 'store'])->name('volunteer.jobs.store');

});

// Student Applications Route with auth
Route::middleware(['auth'])->group(function () {
    Route::get('/students', [StudentController::class, 'index'])->name('admin.students.index');
});

// Admin routes
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/applications', [ScholarshipController::class, 'index'])->name('admin.applications.index');
    Route::post('/applications/{id}/status', [ScholarshipController::class, 'updateStatus'])->name('admin.applications.updateStatus');
    // Student management
    Route::get('/students', [App\Http\Controllers\Admin\StudentController::class, 'index'])
        ->middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])
        ->name('admin.students.index.shortcut');
    Route::post('/students/{tracking_code}/approve', [App\Http\Controllers\Admin\StudentController::class, 'approve'])
        ->middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])
        ->name('admin.students.approve');
    Route::post('/students/{tracking_code}/reject', [App\Http\Controllers\Admin\StudentController::class, 'reject'])
        ->middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])
        ->name('admin.students.reject');
    // Delete student application
    Route::delete('/students/{tracking_code}', [App\Http\Controllers\Admin\StudentController::class, 'destroy'])
        ->middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])
        ->name('admin.students.destroy');

    // Delete student user
    Route::delete('/students/user/{id}', [App\Http\Controllers\Admin\StudentController::class, 'destroyUser'])
        ->middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])
        ->name('admin.students.destroyUser');

    // Admin Volunteer Management
    Route::get('/volunteers', [App\Http\Controllers\AdminController::class, 'volunteerIndex'])->name('admin.volunteers.index');
    Route::post('/volunteers/{volunteer}/approve', [App\Http\Controllers\AdminController::class, 'approveVolunteer'])->name('admin.volunteers.approve');
    Route::post('/volunteers/{volunteer}/reject', [App\Http\Controllers\AdminController::class, 'rejectVolunteer'])->name('admin.volunteers.reject');
    Route::get('/volunteers/{volunteer}/edit', [App\Http\Controllers\AdminController::class, 'editVolunteer'])->name('admin.volunteers.edit');
    Route::put('/volunteers/{volunteer}', [App\Http\Controllers\AdminController::class, 'updateVolunteer'])->name('admin.volunteers.update');
    Route::delete('/volunteers/{volunteer}', [App\Http\Controllers\AdminController::class, 'destroyVolunteer'])->name('admin.volunteers.destroy');
    Route::get('/volunteers/event-applications', [App\Http\Controllers\AdminController::class, 'getVolunteerEventApplications'])->name('admin.volunteers.event-applications');

    // Admin Volunteer Applications Management
    Route::get('/volunteer-applications', [App\Http\Controllers\VolunteerEventApplicationController::class, 'index'])->name('admin.volunteer-applications.index');
    Route::get('/volunteer-applications/{application}', [App\Http\Controllers\VolunteerEventApplicationController::class, 'show'])->name('admin.volunteer-applications.show');
    Route::patch('/volunteer-applications/{application}/status', [App\Http\Controllers\VolunteerEventApplicationController::class, 'updateStatus'])->name('admin.volunteer-applications.update-status');
});

// Admin Scholars Route
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/scholars', [AdminController::class, 'showScholars'])->name('admin.scholars');
});

// Admin Settings Route
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/settings', [AdminController::class, 'showSettings'])->name('admin.settings');
});

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

 // Legal document pages
 Route::get('/terms-scholarship', function () {
    return view('legal.terms-scholarship');
 })->name('terms.scholarship');

// Route::get('/terms-community-scholarship', function () {
//     return view('legal.terms-scholarship');
// })->name('terms.community');

// Route::get('/terms-residential-scholarship', function () {
//     return view('legal.terms-scholarship');
// })->name('terms.residential');

Route::get('/terms-volunteer', function () {
    return view('legal.terms-volunteer');
})->name('terms.volunteer');

Route::get('/privacy-policy', function () {
    return view('legal.privacy-policy');
})->name('privacy.policy');



// Public Job Listing Routes
Route::get('/jobs', [JobListingController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{job}', [JobListingController::class, 'show'])->name('jobs.show');

// Admin Job Management Routes
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/jobs', [App\Http\Controllers\Admin\JobListingController::class, 'index'])->name('admin.jobs.index');
    Route::get('/jobs/create', [App\Http\Controllers\Admin\JobListingController::class, 'create'])->name('admin.jobs.create');
    Route::post('/jobs', [App\Http\Controllers\Admin\JobListingController::class, 'store'])->name('admin.jobs.store');
    Route::get('/jobs/{job}', [App\Http\Controllers\Admin\JobListingController::class, 'show'])->name('admin.jobs.show');
    Route::get('/jobs/{job}/edit', [App\Http\Controllers\Admin\JobListingController::class, 'edit'])->name('admin.jobs.edit');
    Route::put('/jobs/{job}', [App\Http\Controllers\Admin\JobListingController::class, 'update'])->name('admin.jobs.update');
    Route::delete('/jobs/{job}', [App\Http\Controllers\Admin\JobListingController::class, 'destroy'])->name('admin.jobs.destroy');
    Route::post('/jobs/{job}/approve', [App\Http\Controllers\Admin\JobListingController::class, 'approve'])->name('admin.jobs.approve');
    Route::post('/jobs/{job}/reject', [App\Http\Controllers\Admin\JobListingController::class, 'reject'])->name('admin.jobs.reject');
});

// API route for job details (for modal)
Route::get('/api/job-listings/{id}', function($id) {
    return \App\Models\JobListing::findOrFail($id);
});

// Scholarship Application Routes
Route::get('/scholarship/apply', [App\Http\Controllers\ScholarshipController::class, 'showApplyForm'])->name('scholarship.apply.form');
Route::post('/scholarship/apply', [App\Http\Controllers\ScholarshipController::class, 'apply'])->name('scholarship.apply');
Route::get('/scholarship/success/{tracking_code}', [App\Http\Controllers\ScholarshipController::class, 'success'])->name('scholarship.success');
Route::match(['get', 'post'], '/scholarship/track', [App\Http\Controllers\ScholarshipController::class, 'track'])->name('scholarship.track');
Route::get('/scholarship/track/{tracking_code}', [App\Http\Controllers\ScholarshipController::class, 'show'])->name('scholarship.show');

// New route for students to view job listings
Route::get('/jobs/listings', [JobListingController::class, 'index'])->name('jobs.listings');



// Volunteer event application tracking routes
Route::get('/volunteer/track-application', [App\Http\Controllers\VolunteerEventApplicationController::class, 'showTrackForm'])->name('volunteer.event-application.track.form');
Route::post('/volunteer/track-application', [App\Http\Controllers\VolunteerEventApplicationController::class, 'track'])->name('volunteer.event-application.track');
Route::get('/volunteer/application/{tracking_code}', [App\Http\Controllers\VolunteerEventApplicationController::class, 'showByTrackingCode'])->name('volunteer.event-application.show');

// Public volunteer event registration route (for homepage)
Route::post('/volunteer/event-registration', [App\Http\Controllers\VolunteerEventApplicationController::class, 'store'])->name('volunteer.event-registration');

// API route for event details
Route::get('/api/events/{event}', [App\Http\Controllers\EventController::class, 'show'])->name('api.events.show');

// Email test routes (for development only - remove in production)
Route::get('/test-email', function () {
    try {
        $testApplication = new \App\Models\ScholarshipApplication([
            'full_name' => 'Test Student',
            'email' => 'test@example.com',
            'tracking_code' => 'TEST123456',
            'status' => 'pending'
        ]);

        \Illuminate\Support\Facades\Mail::to('hauzhayag15@gmail.com')->send(new \App\Mail\TrackingCodeMail($testApplication));

        return 'Scholarship email sent successfully! Check hauzhayag15@gmail.com';
    } catch (\Exception $e) {
        return 'Email failed: ' . $e->getMessage();
    }
});

Route::get('/test-volunteer-email', function () {
    try {
        $event = \App\Models\Event::first();
        if (!$event) {
            return 'No events found. Please create an event first.';
        }

        $testApplication = new \App\Models\VolunteerEventApplication([
            'full_name' => 'Merrydell Sombrio',
            'email' => 'merrydellsombrio083@gmail.com',
            'tracking_code' => 'NOEKEH1S',
            'status' => 'pending',
            'event_id' => $event->id
        ]);
        $testApplication->event = $event;

        \Illuminate\Support\Facades\Mail::to('merrydellsombrio083@gmail.com')->send(new \App\Mail\VolunteerEventApplicationConfirmation($testApplication));

        return 'Volunteer event email sent successfully! Check merrydellsombrio083@gmail.com';
    } catch (\Exception $e) {
        return 'Email failed: ' . $e->getMessage();
    }
});

// Simple SMTP test route
Route::get('/test-smtp', function () {
    try {
        \Illuminate\Support\Facades\Mail::raw('This is a simple SMTP test from Hauz Hayag system. If you receive this email, SMTP is working correctly!', function($message) {
            $message->to('merrydellsombrio083@gmail.com')
                    ->subject('SMTP Test - Hauz Hayag System');
        });

        return 'SMTP test email sent successfully! Check your inbox at merrydellsombrio083@gmail.com';

    } catch (\Exception $e) {
        return 'SMTP Error: ' . $e->getMessage();
    }
});

// Admin user management routes (for development/debugging)
// Route::get('/create-admin', function () { ... });
// Route::get('/list-admins', function () { ... });


