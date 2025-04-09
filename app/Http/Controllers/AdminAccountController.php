<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminAccountController extends Controller
{
    // show admin register page
    public function showAdminRegister(){
        return view('admin.account.adminRegister');
    }

    // Handle admin registration form submission
    public function registerAdmin(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8',
        ], [
            // Custom error messages
            'name.required' => 'The full name field is required.',
            'name.string' => 'The full name must be a valid string.',
            'name.max' => 'The full name must not exceed 255 characters.',
        
            'email.required' => 'The email address field is required.',
            'email.string' => 'The email address must be a valid string.',
            'email.email' => 'The email address must be a valid email.',
            'email.max' => 'The email address must not exceed 255 characters.',
            'email.unique' => 'The email address is already in use.',
        
            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be a valid string.',
            'password.min' => 'The password must be at least 8 characters long.',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create a new admin
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirect to a success page or login page
        return redirect()->route('admin.login')->with('success', 'Admin account created successfully..!!');
    }

    // show admin login page
    public function showAdminLogin(){
        return view('admin.account.adminLogin');
    }
    
    public function adminLogin(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // First find the admin by email
        $admin = Admin::where('email', $request->email)->first();

        // Check if admin exists
        if ($admin) {
            // Check if password matches
            if (Hash::check($request->password, $admin->password)) {
                // Login successful
                Auth::guard('admin')->login($admin, $request->filled('remember'));
                
                // Regenerate session
                $request->session()->regenerate();

                return redirect()->intended(route('admin.dashboard'))
                    ->with('success', 'Welcome back!');
            } else {
                // Password doesn't match
                return back()->with('error', 'Email or password is incorrect..!!' )->withInput($request->except('password'));
            }
        } else {
            // Admin not found
            return back()->with('error', 'Email or password is incorrect..!!' )->withInput($request->except('password'));
        }
    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'You have been successfully logged out..!!');
    }

}
