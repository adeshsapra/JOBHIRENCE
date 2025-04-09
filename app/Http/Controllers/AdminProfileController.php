<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Company;
use App\Models\Jobs;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class AdminProfileController extends Controller
{
    public function showAdminProfile()
    {
        $adminId = Auth::guard('admin')->id();
        $admin = Admin::findOrFail($adminId);
        
        // Fetch dashboard statistics
        $registeredUsers = User::count();
        $registeredCompanies = Company::count();
        $activeJobListings = Jobs::where('status', 1)->count();
        $totalApplications = JobApplication::count();

        // Fetch recent job postings
        $recentJobs = Jobs::with('company')
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->take(5) 
            ->get();

        return view('admin.panel.adminProfile', compact(
            'admin',
            'registeredUsers',
            'registeredCompanies',
            'activeJobListings',
            'totalApplications',
            'recentJobs'
        ));
    }

    public function showEditProfile()
    {
        $adminId = Auth::guard('admin')->id();
        $admin = Admin::findOrFail($adminId);
        
        if ($admin) {
            return view('admin.panel.editProfile', compact('admin'));
        }
        
        return redirect()->route('admin.login')
            ->with('error', 'Please login to continue.');
    }

    public function updateProfile(Request $request)
    {
        $adminId = Auth::guard('admin')->id();
        $admin = Admin::findOrFail($adminId);
        
        if (!$admin) {
            return redirect()->route('admin.login')
                ->with('error', 'Please login to continue.');
        }
    
        // Validate the request
        $validator = validator($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $adminId,
            'profile_img' => 'nullable|image|mimes:jpeg,png,jpg,webp' // Add webp support
        ]);
    
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
    
        // Handle photo upload
        if ($request->hasFile('profile_img') && $request->file('profile_img')->isValid()) {
            // Delete old photo if exists
            if ($admin->profile_img) {
                $oldPhotoPath = public_path('admin_photos/' . $admin->profile_img);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath); // Delete the old file
                }
            }
    
            // Define the upload directory
            $uploadPath = public_path('admin_photos');
            
            // Ensure the directory exists
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true); // Create the directory if it doesn't exist
            }
    
            // Generate a unique file name
            $photoName = time() . '_' . $adminId . '.' . $request->profile_img->extension();
    
            // Move the file to the upload directory
            $request->profile_img->move($uploadPath, $photoName);
    
            // Save the file name in the database
            $admin->profile_img = $photoName;
        }
    
        // Update admin details
        $admin->name = $request->name;
        $admin->email = $request->email;
        
        if ($admin->save()) {
            return redirect()->route('admin.profile')
                ->with('success', 'Profile updated successfully..!!');
        }
        
        return back()
            ->with('error', 'Failed to update profile.')
            ->withInput();
    }

    public function updatePassword(Request $request)
    {
        $adminId = Auth::guard('admin')->id();
        $admin = Admin::findOrFail($adminId);
        
        if (!$admin) {
            return redirect()->route('admin.login')
                ->with('error', 'Please login to continue.');
        }

        // Validate the request
        $validator = validator($request->all(), [
            'current_password' => 'required',
            'new_password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // Check if current password matches
        if (!Hash::check($request->current_password, $admin->password)) {
            return back()
                ->withErrors(['current_password' => 'The provided password does not match your current password.']);
        }

        // Update password
        $admin->password = Hash::make($request->new_password);
        
        if ($admin->save()) {
            return redirect()->route('admin.profile')
                ->with('success', 'Password changed successfully..!!');
        }
        
        return back()
            ->with('error', 'Failed to update password.')
            ->withInput();
    }
}