@extends('layouts.app')

@section('content')
    <!-- Full Screen Container with Gradient Background -->
    <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-gray-200 via-gray-300 to-gray-500">
        <div class="bg-white p-8 rounded-xl shadow-xl w-full max-w-md space-y-6 transform transition-all duration-500 hover:shadow-2xl">
            <!-- Display logo if required -->
            <x-logo />

            <!-- Card Header -->
            <x-card-header class="text-2xl font-bold text-gray-800 text-center">{{ __('Request OTP for Password Reset') }}</x-card-header>

            <!-- Success Message -->
            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Request OTP Form -->
            <x-form :action="route('otp.password.request')">
                <!-- Email Input Field -->
                <x-input type="email" name="email" label="Email Address" placeholder="Enter your email" required />

                <!-- Send OTP Button -->
                <x-button class="w-full py-3 px-6 mt-6 bg-gradient-to-r from-gray-600 to-gray-800 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out">
                    {{ __('Send OTP') }}
                </x-button>
            </x-form>
        </div>
    </div>
@endsection
