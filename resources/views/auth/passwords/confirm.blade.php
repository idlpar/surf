@extends('layouts.app')

@section('content')
    <!-- Main Container with Gradient Background -->
    <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-teal-50 via-blue-100 to-purple-200">
        <div class="bg-white p-8 rounded-xl shadow-xl w-full max-w-md space-y-6 transform transition-all duration-500 hover:shadow-2xl">
            <!-- Display Logo if Required -->
            <x-logo />

            <!-- Header with Custom Color -->
            <x-card-header class="text-2xl font-bold text-purple-800 text-center">{{ __('Verify OTP & Reset Password') }}</x-card-header>

            <!-- Display Errors -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- OTP Verification Form -->
            <x-form :action="route('otp.password.verify')">
                @csrf

                <!-- Hidden email input -->
                <input type="hidden" name="email" value="{{ $email }}" />

                <!-- OTP and Password Fields with Placeholder and Styling -->
                <x-input type="text" name="otp" label="OTP" placeholder="Enter OTP" required />
                <x-input type="password" name="password" label="New Password" placeholder="Enter new password" required />
                <x-input type="password" name="password_confirmation" label="Confirm New Password" placeholder="Confirm your password" required />

                <!-- Submit Button with Gradient Color -->
                <x-button class="w-full py-3 px-6 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out">
                    {{ __('Verify OTP & Reset Password') }}
                </x-button>
            </x-form>
        </div>
    </div>
@endsection
