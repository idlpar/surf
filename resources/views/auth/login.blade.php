@extends('layouts.app')

@section('content')
    <!-- Main Container -->
    <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-r from-blue-100 to-purple-200">
        <!-- Card for Login Form -->
        <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md space-y-6 transform transition-all duration-500 hover:shadow-2xl">

            <!-- Reuse Logo Component -->
            <x-logo />

            <!-- Sign In Header -->
            <x-card-header class="text-2xl font-bold text-gray-800 text-center">{{ __('Sign in to your account') }}</x-card-header>

            <!-- Reuse Form Component -->
            <x-form :action="route('login')">
                <x-input
                type="email"
                name="email"
                label="Email address"
                :value="old('email')"
                placeholder="Enter your email"
                autocomplete="email"
                required
                    :errors="$errors"
                />

                <!-- Password Field -->
                <x-input
                    type="password"
                    name="password"
                    label="Password"
                    placeholder="Enter your password"
                    autocomplete="current-password"
                    required
                    :errors="$errors"
                />


                <!-- Remember Me and Forgot Password -->
                <div class="flex items-center justify-between text-gray-600 mt-4">
                    <label class="inline-flex text-base items-center">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <span class="ml-2 text-sm">{{ __('Remember me') }}</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800">Forgot password?</a>
                </div>

                <!-- Sign In Button -->
                <x-button class="w-full py-3 px-6 mt-6 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition duration-300 ease-in-out">
                    {{ __('Sign in') }}
                </x-button>

                <!-- Or Continue With Section -->
                <div class="relative mt-8 mb-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500">Or continue with</span>
                    </div>
                </div>

                <!-- Social Login Buttons -->
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('social.redirect', 'google') }}" class="flex items-center justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-md bg-white hover:bg-gray-50 transition transform hover:-translate-y-1 duration-300 ease-in-out">
                        <img src="{{ asset('logos/google.svg') }}" alt="Google" class="w-5 h-5 mr-2"> Google
                    </a>
                    <a href="{{ route('social.redirect', 'github') }}" class="flex items-center justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-md bg-white hover:bg-gray-50 transition transform hover:-translate-y-1 duration-300 ease-in-out">
                        <img src="{{ asset('logos/github.svg') }}" alt="GitHub" class="w-5 h-5 mr-2"> Github
                    </a>
                </div>
            </x-form>

            <!-- Sign Up Link -->
            <div class="text-center mt-8">
                <p class="text-base text-gray-600">Not a member? <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-800 transition duration-300 ease-in-out">Register Now!</a></p>
            </div>
        </div>
    </div>
@endsection
