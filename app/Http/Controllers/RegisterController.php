<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\User;
use App\Mail\SendOtpMail;

class RegisterController extends Controller
{
    // Registration method
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:4|confirmed',
        ]);

        try {
            DB::beginTransaction();

            // Create new user (unverified)
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);

            // Generate OTP
            $otp = rand(100000, 999999);
            $user->otp = $otp;
            $user->otp_created_at = Carbon::now();
            $user->save();

            // Send OTP email
            Mail::to($user->email)->queue(new SendOtpMail($otp)); // Queue the email

            DB::commit();
            return redirect()->route('show.otp.form')->with('success', 'OTP has been sent to your email. Please verify to complete registration.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to register user: ' . $e->getMessage());
        }
    }

    // Show OTP Verification Form
    public function showOtpForm()
    {
        return view('auth.verify_otp');
    }

    // Verify OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('otp_created_at', '>', Carbon::now()->subMinutes(10)) // OTP valid for 10 minutes
            ->first();

        if ($user) {
            // OTP is valid, verify the user
            $user->email_verified_at = now();
            $user->otp = null;
            $user->otp_created_at = null;
            $user->save();

            Auth::login($user);
            return redirect('home')->with('success', 'Your email has been verified and you are now logged in.');
        } else {
            return redirect()->back()->with('error', 'Invalid or expired OTP.');
        }
    }

    // Resend OTP Method
    public function resendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        // Check if the user exists and has not yet verified their email
        if ($user && !$user->email_verified_at) {
            // Generate a new OTP
            $otp = rand(100000, 999999);
            $user->otp = $otp;
            $user->otp_created_at = Carbon::now();
            $user->save();

            // Queue the OTP email
            Mail::to($user->email)->queue(new SendOtpMail($otp)); // Queue the email

            return redirect()->back()->with('success', 'A new OTP has been sent to your email.');
        }

        return redirect()->back()->with('error', 'User not found or already verified.');
    }

    // Login method
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            if ($user->is_blocked) {
                return redirect()->back()->with('error', 'Your account has been blocked. Please contact support.');
            }

            if (!$user->email_verified_at) {
                return redirect()->route('show.otp.form')->with('error', 'Please verify your email first.');
            }

            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect('home')->with('success', 'login successful');
            } else {
                return redirect()->back()->with('error', 'Password is incorrect.');
            }
        } else {
            return redirect()->back()->with('error', 'User not found.');
        }
    }

    // Logout method
    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
