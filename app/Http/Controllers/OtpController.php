<?php

namespace App\Http\Controllers;

use App\Jobs\SendOtpJob;
use App\Models\User;
use App\Notifications\SendOtpNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class OtpController extends Controller
{
    /**
     * Verify OTP for general purposes (e.g., account verification)
     */
    public function verifyOtp(Request $request)
    {
        // Validate request data
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string|max:6',
        ]);

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No user found with this email.']);
        }

        // Check if the user is locked out
        if ($user->otp_locked_until && Carbon::parse($user->otp_locked_until)->isFuture()) {
            $lockoutTimeRemaining = Carbon::parse($user->otp_locked_until)->diffForHumans();
            return back()->withErrors(['otp' => "Account is locked due to too many failed attempts. Please try again in $lockoutTimeRemaining."]);
        }

        // Check if the OTP is correct and not expired
        if (Hash::check($request->otp, $user->otp) && Carbon::parse($user->otp_expires_at)->isFuture()) {
            // OTP is correct and not expired, reset attempts
            $user->email_verified_at = Carbon::now();
            $user->otp = null; // Clear OTP
            $user->otp_expires_at = null;
            $user->otp_attempts = 0; // Reset attempts
            $user->otp_locked_until = null; // Clear lockout time
            $user->save();

            return redirect()->route('home')->with('status', 'OTP verified successfully!');
        } else {
            // Increment OTP attempts
            $user->otp_attempts += 1;

            if ($user->otp_attempts >= 3) {
                // Lock the account for 15 minutes after 3 failed attempts
                $user->otp_locked_until = Carbon::now()->addMinutes(15);
                $user->save();
                return back()->withErrors(['otp' => 'Too many failed attempts. Account is locked for 15 minutes.']);
            }

            // Save the updated attempts
            $user->save();

            return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }
    }

    /**
     * Resend OTP
     */
    public function resendOtp(Request $request)
    {
        // Apply rate limiting to prevent abuse
        $this->ensureIsNotRateLimited($request);

        // Retrieve the user by the provided email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Generate a new OTP
        $otp = rand(100000, 999999);
        $otpExpiry = Carbon::now()->addMinutes(5); // OTP expires in 5 minutes

        // Update the user with the new hashed OTP and expiry time
        $user->otp = Hash::make($otp);  // Hash the OTP before saving
        $user->otp_expires_at = $otpExpiry;
        $user->save();

        // Dispatch OTP job
        SendOtpJob::dispatch($user->email, $otp);

        // Send the new OTP via notification
//        $user->notify(new SendOtpNotification($otp));

        // Clear rate limiter
        RateLimiter::clear($this->throttleKey($request));

        return redirect()->route('otp.form')->with('message', 'OTP has been resent.');
    }

    /**
     * Custom rate limiting check
     */
    protected function ensureIsNotRateLimited(Request $request)
    {
        if (RateLimiter::tooManyAttempts($this->throttleKey($request), 3)) {
            throw ValidationException::withMessages([
                'email' => ['Too many requests. Please try again later.'],
            ]);
        }

        RateLimiter::hit($this->throttleKey($request), 60); // 60 seconds cooldown between attempts
    }

    /**
     * Throttle key for rate limiting based on the user's email
     */
    protected function throttleKey(Request $request)
    {
        return strtolower($request->email) . '|' . $request->ip();
    }

    /**
     * Request OTP for password reset (with rate limiting and OTP hashing)
     */
    public function requestPasswordResetOtp(Request $request)
    {
        $this->ensureIsNotRateLimited($request);

        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $otp = rand(100000, 999999);
            $user->otp = Hash::make($otp);  // Hash the OTP before saving
            $user->otp_expires_at = Carbon::now()->addMinutes(5);
            $user->save();

            // Send OTP
            $user->notify(new SendOtpNotification($otp));
        }

        RateLimiter::clear($this->throttleKey($request));

        return redirect()->route('otp.password.request.form', ['email' => $request->email])
            ->with('status', 'If the email is registered, an OTP has been sent.');    }

    /**
     * Verify OTP for password reset
     */
    public function verifyPasswordResetOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string|max:6',
            'password' => 'required|string|confirmed|min:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['otp' => 'Invalid OTP or user not found.']);
        }

        if (Hash::check($request->otp, $user->otp) && Carbon::parse($user->otp_expires_at)->isFuture()) {
            // Reset password
            $user->password = Hash::make($request->password);
            $user->otp = null; // Clear OTP after successful reset
            $user->otp_expires_at = null;
            $user->save();

            return redirect()->route('login')->with('status', 'Password reset successfully!');
        }

        return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
    }
}
