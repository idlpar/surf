<?php

use Illuminate\Http\Request;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Test Route
Route::get('/test', function () {
    return view('test');
});

// Home Route (Only verified users can see this page)
Route::get('/', function () {
    return view('home');
})->name('home');
//Route::get('/', function () {
//    return view('home');
//})->middleware(['auth', 'verified'])->name('home');

// Authentication Routes with Email Verification
Auth::routes(['verify' => true]);

/*
|--------------------------------------------------------------------------
| OTP Routes
|--------------------------------------------------------------------------
|
| Routes to handle OTP verification and password reset with OTP.
| These are used for both general and password-specific OTPs.
|
*/

// OTP Form Route (For users authenticated but not verified)
Route::get('/otp', function () {
    // if (Auth::check() && !Auth::user()->hasVerifiedEmail()) {
    if (Auth::check() && !Auth::hasVerifiedEmail()) {
        return view('auth.otp');
    }
    return redirect()->route('home');
})->middleware('auth')->name('otp.form');


// OTP Request Form (Password Reset)
Route::get('password/otp', function (Request $request) {
    return view('auth.passwords.confirm', ['email' => $request->query('email')]);
})->name('otp.password.request.form');

// OTP Verification (General Purpose)
Route::post('otp/verify', [OtpController::class, 'verifyOtp'])->name('otp.verify');

// Resend OTP
Route::post('otp/resend', [OtpController::class, 'resendOtp'])->name('otp.resend');

// Request OTP for Password Reset
Route::post('password/otp', [OtpController::class, 'requestPasswordResetOtp'])->name('otp.password.request');

// Verify OTP and Reset Password
Route::post('password/otp/verify', [OtpController::class, 'verifyPasswordResetOtp'])->name('otp.password.verify');

/*
|--------------------------------------------------------------------------
| Home and Social Login Routes
|--------------------------------------------------------------------------
|
| Routes for home page and social authentication via providers.
|
*/

// Home Route
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.dashboard');
});

Route::middleware(['auth', AuthAdmin::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
});

// Social Login Routes
Route::get('/login/{provider}', [SocialController::class, 'redirectToProvider'])->name('social.redirect');
Route::get('/login/{provider}/callback', [SocialController::class, 'handleProviderCallback'])->name('social.callback');
