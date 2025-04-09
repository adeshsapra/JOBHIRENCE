<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    // show forgot password form
    public function showForgotPasswordForm()
    {
        return view('front.account.forgot-password.forgot-password');
    }

    // sent otp
    public function sendOtp(Request $request)
    {
        $email = $request->input('email');

        // Check if email is provided
        if (!$email) {
            return redirect()->back()->with('error', 'Email is required.');
        }

        // Check if email exists in the database
        $user = User::where('email', $email)->first();

        if (!$user) {
            // Email does not exist
            return redirect()->back()->with('error', 'This email address is not registered.');
        }

        // Email exists, generate and send OTP
        $otp = rand(100000, 999999);

        // Save OTP to the password_resets table
        $saved = DB::table('password_resets')->updateOrInsert(
            ['email' => $email],
            ['otp' => $otp, 'created_at' => now()]
        );

        if ($saved) {
            // Send OTP via email
            Mail::raw("Your OTP is: $otp", function ($message) use ($email) {
                $message->to($email)->subject('Password Reset OTP');
            });

            // Store email in the session for use in further steps
            $request->session()->put('email', $email);

            return redirect()->route('account.showVerifyOtpForm')
                ->with('success', 'OTP sent successfully. Please check your email.');
        }

        // Fallback for OTP save failure
        return redirect()->back()->with('error', 'Failed to generate OTP. Please try again later.');
    }

    

    // show verify otp form
    public function showVerifyOtpForm(Request $request)
    {
        return view('front.account.forgot-password.verify-otp', ['email' => $request->session()->get('email')]);
        // return view('front.account.forgot-password.verify-otp');
    }

    public function verifyOtp(Request $request)
{
    $email = $request->input('email');
    $otp = $request->input('otp');

    if (!$email || !$otp) {
        return redirect()->back()->with('error', 'Email and OTP are required.');
    }

    $record = DB::table('password_resets')->where('email', $email)->where('otp', $otp)->first();

    if ($record && $record->created_at >= now()->subMinutes(15)) {
        // OTP is valid, redirect to reset password form with email
        return redirect()->route('account.showResetForm')->with('email', $email);
    }

    // Invalid or expired OTP
    return redirect()->back()->with('error', 'Invalid or expired OTP.');
}


    // show reset password form
    public function showResetForm(Request $request)
    {
        // return view('front.account.forgot-password.reset-password');
        return view('front.account.forgot-password.reset-password', ['email' => $request->session()->get('email')]);
    }

    public function resetPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ], [
        'email.required' => 'Email is required.',
        'email.email' => 'Invalid email format.',
        'password.required' => 'Password is required.',
        'password.min' => 'Password must be at least 8 characters.',
        'password.confirmed' => 'Passwords do not match.',
    ]);

    $email = $request->input('email');
    $password = $request->input('password');

    $user = User::where('email', $email)->first();

    if ($user) {
        $user->password = bcrypt($password);
        $user->save();

        // Delete the password reset entry
        DB::table('password_resets')->where('email', $email)->delete();

        return redirect()->route('account.userLogin')->with('success', 'Password reset successfully.');
    }

    return redirect()->back()->with('error', 'Failed to reset password. Please try again.');
}

}
