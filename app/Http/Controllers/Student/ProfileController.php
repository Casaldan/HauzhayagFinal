<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function uploadPicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $user = Auth::user();

            // Delete old profile picture if exists
            if ($user->profile_picture) {
                Storage::delete('public/' . $user->profile_picture);
            }

            // Store new profile picture
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');

            // Update user profile picture path
            $user->update([
                'profile_picture' => $path
            ]);

            return redirect()->back()->with('success', 'Profile picture updated successfully!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to upload profile picture. Please try again.');
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        try {
            $user = Auth::user();

            // Debug logging
            \Log::info('Student password change attempt', [
                'user_id' => $user->id,
                'email' => $user->email,
                'has_temporary_password' => !empty($user->temporary_password)
            ]);

            // Check if current password matches
            // If user has temporary password, check against that, otherwise check hashed password
            if ($user->temporary_password) {
                if ($request->current_password !== $user->temporary_password) {
                    return redirect()->back()->with('error', 'Current password is incorrect. Please use the password from your email.');
                }
            } else {
                if (!Hash::check($request->current_password, $user->password)) {
                    return redirect()->back()->with('error', 'Current password is incorrect.');
                }
            }

            // Update password
            $user->update([
                'password' => Hash::make($request->new_password),
                'temporary_password' => null // Clear temporary password after change
            ]);

            \Log::info('Student password changed successfully', [
                'user_id' => $user->id,
                'email' => $user->email
            ]);

            return redirect()->back()->with('success', 'Password changed successfully! You can now use your new password to login.');

        } catch (\Exception $e) {
            \Log::error('Student password change error', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage()
            ]);
            return redirect()->back()->with('error', 'Failed to change password. Please try again.');
        }
    }
}
