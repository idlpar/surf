<?php

use App\Http\Controllers\ShopController;
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
//Route::get('/', function () {
//    return view('home');
//})->name('home');
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
     if (Auth::check() && !Auth::user()->hasVerifiedEmail()) {
//    if (Auth::check() && !Auth::hasVerifiedEmail()) {
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
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{product_slug}', [ShopController::class, 'product_details'])->name('shop.product.details');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.dashboard');
});

Route::middleware(['auth', AuthAdmin::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/brands', [AdminController::class, 'brands'])->name('admin.brands');
    Route::get('/admin/brands/add', [AdminController::class, 'brand_add'])->name('admin.brand.add');
    Route::post('/admin/brands/store', [AdminController::class, 'brand_store'])->name('admin.brand.store');
    Route::get('/admin/brands/edit/{id}', [AdminController::class, 'brand_edit'])->name('admin.brand.edit');
    Route::post('/admin/brands/update', [AdminController::class, 'brand_update'])->name('admin.brand.update');
    Route::delete('/admin/brands/{id}/delete', [AdminController::class, 'brand_delete'])->name('admin.brand.delete');

    Route::get('/admin/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::get('/admin/categories/add', [AdminController::class, 'category_add'])->name('admin.category.add');
    Route::post('/admin/categories/store', [AdminController::class, 'category_store'])->name('admin.category.store');
    Route::get('/admin/categories/edit/{id}', [AdminController::class, 'category_edit'])->name('admin.category.edit');
    Route::post('/admin/categories/update', [AdminController::class, 'category_update'])->name('admin.category.update');
    Route::delete('/admin/categories/{id}/delete', [AdminController::class, 'category_delete'])->name('admin.category.delete');

    Route::get('/admin/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/admin/products/add', [AdminController::class, 'product_add'])->name('admin.product.add');
    Route::post('/admin/products/store', [AdminController::class, 'product_store'])->name('admin.product.store');
    Route::get('/admin/products/{id}/edit', [AdminController::class, 'product_edit'])->name('admin.product.edit');
    Route::post('/admin/products/{id}/update', [AdminController::class, 'product_update'])->name('admin.product.update');
    Route::delete('/admin/products/{id}/delete', [AdminController::class, 'product_delete'])->name('admin.product.delete');
});

// Social Login Routes
Route::get('/login/{provider}', [SocialController::class, 'redirectToProvider'])->name('social.redirect');
Route::get('/login/{provider}/callback', [SocialController::class, 'handleProviderCallback'])->name('social.callback');
