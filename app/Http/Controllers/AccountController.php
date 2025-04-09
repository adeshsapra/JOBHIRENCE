<?php

namespace App\Http\Controllers;

use App\Models\User;    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AccountController extends Controller
{
    //show the user registration page
    public function showUserRegistration(){
        return view('front.account.userRegistration');
    }

    public function registration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => ['required', 'string', 'regex:/^[a-zA-Z\s]+$/', 'min:3', 'max:50'],
            'email' => 'required|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8',               // Minimum 8 characters
                'max:20',              // Maximum 20 characters
                'regex:/[A-Z]/',       // At least one uppercase letter
                'regex:/[a-z]/',       // At least one lowercase letter
                'regex:/[0-9]/',       // At least one number
                'regex:/[@$!%*?&]/'    // At least one special character
            ],
            'mobile' => 'required|digits:10|regex:/^[6-9]\d{9}$/|unique:users,mobile_number',
        ], [
            'fullname.required' => 'Full name is required.',
            'fullname.string' => 'Full name must be a string.',
            'fullname.regex' => 'Full name should only contain letters and spaces.',
            'fullname.min' => 'Full name must be at least 3 characters.',
            'fullname.max' => 'Full name must not exceed 50 characters.',
    
            'email.required' => 'Email is required.',
            'email.email' => 'Enter a valid email address.',
            'email.unique' => 'The email address is already registered.',
    
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.max' => 'Password must not exceed 20 characters.',
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character (@$!%*?&).',
    
            'mobile.required' => 'Mobile number is required.',
            'mobile.digits' => 'Mobile number must be exactly 10 digits.',
            'mobile.regex' => 'Mobile number must start with 6, 7, 8, or 9.',
            'mobile.unique' => 'The mobile number is already registered.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'fullName' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password
            'mobile_number' => $request->mobile,
        ]);

        if ($user) {
            return redirect()->route('account.userLogin')->with('success', 'Registration successful..!!');
        } else {
            return redirect()->back()->with('error', 'Failed to save user data. Please try again.')->withInput();
        }
    }                   

    //show the user login page
    public function showUserLogin(){
        return view('front.account.userLogin');
    }

    public function userAuthenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user(); 
            session(['logged_in_user' => $user->id]);

            return redirect()->route('account.userProfile')->with('success', 'Login successful!');
        } else {
            $user = User::where('email', $request->email)->first();
            
            if (!$user) {
                return redirect()->back()
                    ->with('error', 'The email address is not registered.')
                    ->withInput();
            } else {    
                return redirect()->back()
                    ->with('error', 'Invalid email or password.')
                    ->withInput();
            }
        }
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Get the profile image URL - try different properties that might be available
            $profileImageUrl = null;
            
            // Try common properties where avatar might be stored
            if (property_exists($googleUser, 'avatar_original')) {
                $profileImageUrl = $googleUser->avatar_original;
            } elseif (property_exists($googleUser, 'avatar')) {
                $profileImageUrl = $googleUser->avatar;
            } else {
                // Fallback to basic getAvatar method
                $profileImageUrl = $googleUser->getAvatar();
            }
            
            // Remove query parameters from image URL to get clean image
            if ($profileImageUrl) {
                $profileImageUrl = preg_replace('/\?.*/', '', $profileImageUrl);
            }
            
            // Check if user exists with this email
            $existingUser = User::where('email', $googleUser->email)->first();
            
            if ($existingUser) {
                // Always update the Google ID and image on every login
                $existingUser->google_id = $googleUser->id;
                $existingUser->image = $profileImageUrl;
                $existingUser->save();
                
                // Log in the user
                Auth::login($existingUser);
                session(['logged_in_user' => $existingUser->id]);
                
                return redirect()->route('account.userProfile')
                    ->with('success', 'Login successful with Google!');
            } else {
                // Create a new user
                $newUser = new User();
                $newUser->fullName = $googleUser->name;
                $newUser->email = $googleUser->email;
                $newUser->google_id = $googleUser->id;
                $newUser->image = $profileImageUrl;
                $newUser->password = Hash::make(Str::random(16)); // Random password
                $newUser->save();
                
                Auth::login($newUser);
                session(['logged_in_user' => $newUser->id]);
                
                return redirect()->route('account.userProfile')
                    ->with('success', 'Account created successfully with Google!');
            }
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Google login error: ' . $e->getMessage());
            return redirect()->route('account.userLogin')
                ->with('error', 'Google authentication failed: ' . $e->getMessage());
        }
    }


    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback()
    {
        try {
            $githubUser = Socialite::driver('github')->user();
            
            // Get the profile image URL
            $profileImageUrl = $githubUser->getAvatar();
            
            // Remove query parameters from image URL to get clean image
            if ($profileImageUrl) {
                $profileImageUrl = preg_replace('/\?.*/', '', $profileImageUrl);
            }
            
            // Check if user exists with this email
            // Note: GitHub might not provide email if user set it as private
            $email = $githubUser->getEmail() ?? "{$githubUser->getId()}@github.user";
            
            $existingUser = User::where(function ($query) use ($githubUser, $email) {
                $query->where('github_id', $githubUser->getId())
                    ->orWhere('email', $email);
            })->first();
            
            if ($existingUser) {
                // Always update the GitHub ID and image on every login
                $existingUser->github_id = $githubUser->getId();
                if (!$existingUser->image && $profileImageUrl) {
                    $existingUser->image = $profileImageUrl;
                }
                $existingUser->save();
                
                // Log in the user
                Auth::login($existingUser);
                session(['logged_in_user' => $existingUser->id]);
                
                return redirect()->route('account.userProfile')
                    ->with('success', 'Login successful with GitHub!');
            } else {
                // Create a new user
                $newUser = new User();
                $newUser->fullName = $githubUser->getName() ?? 'GitHub User';
                $newUser->email = $email;
                $newUser->github_id = $githubUser->getId();
                $newUser->image = $profileImageUrl;
                $newUser->password = Hash::make(Str::random(16)); // Random password
                $newUser->save();
                
                Auth::login($newUser);
                session(['logged_in_user' => $newUser->id]);
                
                return redirect()->route('account.userProfile')
                    ->with('success', 'Account created successfully with GitHub!');
            }
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('GitHub login error: ' . $e->getMessage());
            return redirect()->route('account.userLogin')
                ->with('error', 'GitHub authentication failed: ' . $e->getMessage());
        }
    }

    // user account settings
    public function showAccountSetting(){
        $user = Auth::user();
        return view('front.account.accountSetting', compact('user'));
    }

     // Update user email
     public function updateEmail(Request $request)
     {
         $validator = Validator::make($request->all(), [
             'email' => 'required|email|unique:users,email',
         ], [
             'email.unique' => 'The email address is already registered.',
         ]);
 
         if ($validator->fails()) {
             return redirect()->back()->withErrors($validator)->withInput();
         }
 
         $userId = Auth::id();
 
         $user = DB::table('users')->where('id', $userId)->first();
 
         if ($user) {
             DB::table('users')
                 ->where('id', $userId)
                 ->update(['email' => $request->email]);
 
             return redirect()->back()->with('success', 'Email updated successfully..!!');
         } else {
             return redirect()->back()->with('error', 'User not found.');
         }
     }
 
     // Update user mobile number
     public function updateMobile(Request $request)
     {
         $validator = Validator::make($request->all(), [
             'mobile' => 'required|digits:10|unique:users,mobile_number',
         ], [
             'mobile.unique' => 'The mobile number is already registered.',
         ]);
 
         if ($validator->fails()) {
             return redirect()->back()->withErrors($validator)->withInput();
         }
 
         $userId = Auth::id();
 
         $user = DB::table('users')->where('id', $userId)->first();
 
         if ($user) {
             DB::table('users')
                 ->where('id', $userId)
                 ->update(['mobile_number' => $request->mobile]);
 
             return redirect()->back()->with('success', 'Mobile number updated successfully..!!');
         } else {
             return redirect()->back()->with('error', 'User not found.');
         }
     }
 
     // Update user password
     public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ],['confirmed' => 'The new & old password does match']);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('error', $validator->errors()->first())
                ->withInput();
        }

        $userId = Auth::id();
        $user = DB::table('users')->where('id', $userId)->first();

        if ($user) {
            if (Hash::check($request->old_password, $user->password)) {
                DB::table('users')
                    ->where('id', $userId)
                    ->update(['password' => Hash::make($request->new_password)]);

                return redirect()->back()->with('success', 'Password updated successfully..!!');
            } else {
                return redirect()->back()->with('error', 'Old password is incorrect.');
            }
        } else {
            return redirect()->back()->with('error', 'User not found.');
        }
    }

    // show feedback page
    public function feedback(){
        return view('front.account.feedback');
    }

    // save feedbacks in database
    public function saveFeedback(Request $request)
    {
        // Validate inputs
        $request->validate([
            'rating' => 'required|integer|min:1|max:5', 
            'feedback' => 'nullable|string|max:255',
        ]);

        if (Auth::check()) { // Ensure user is logged in
            $feedbackText = $request->feedback ? ucwords(strtolower($request->feedback)) : null;

            $inserted = DB::table('feedbacks')->insert([
                'user_id' => Auth::id(),
                'rating' => $request->rating,
                'feedback' => $feedbackText,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if ($inserted) {
                return redirect()->back()->with('success', 'Thank you for your feedback..!!');
            } else {
                return redirect()->back()->with('error', 'Failed to save feedback. Please try again.');
            }
        } else {
            return redirect()->route('account.userLogin')->with('error', 'You must be logged in to provide feedback.');
        }
    }

    // about us page
    public function aboutUs(){
        $feedbacks = DB::table('feedbacks')
                        ->join('users', 'feedbacks.user_id', '=', 'users.id')
                        ->where('feedbacks.is_feedback', 1)
                        ->orderBy('feedbacks.created_at', 'desc')
                        ->select(
                            'feedbacks.*', 
                            'users.fullname as user_name',
                            'users.image as user_image'
                        )
                        ->get();
    

        return view('front.account.aboutUs', compact('feedbacks'));
    }

    // contact us page
    
    public function showContactUs(){
        return view('front.account.contactUs');
    }

    // for a logout
    public function userLogout()
    {
        Auth::logout();
        session()->forget('logged_in_user');
        return redirect()->route('account.userLogin')->with('success', 'Logged out successfully!');
    }
}