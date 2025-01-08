<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Notifications\SendOtpNotification;
use Illuminate\Http\Request; // Move this outside the class


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default, this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //    protected $redirectTo = '/home';
    //    protected $redirectTo = '/email/verify';
    protected $redirectTo = '/otp'; // Redirect to OTP form

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'digits:11', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Generate OTP
        $otp = rand(100000, 999999); // or use a numeric OTP: rand(100000, 999999) or Str::random(6)
        $otpExpiry = Carbon::now()->addMinutes(5); // OTP expiration time

        // Create the user
        $user = User::create([
            'name' => $data['name'],
            'mobile' => $data['mobile'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'otp' => Hash::make($otp),// Store OTP in the database
            'otp_expires_at' => $otpExpiry, // Set OTP expiration time
        ]);

        // Send OTP via notification (e.g., email)
        $user->notify(new SendOtpNotification($otp));

        return $user;
    }

    /**
     * Redirect users after registration to the OTP verification page.
     */
    protected function registered(Request $request, $user)
    {
        return redirect()->route('otp.form'); // Redirect to OTP verification form
    }

    /**
     * Verify the OTP entered by the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */

}
