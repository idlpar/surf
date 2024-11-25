@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex justify-center items-center bg-gradient-to-br from-green-300 via-blue-400 to-purple-500">
        <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md space-y-6 transform transition-all duration-500 hover:shadow-2xl">
            <!-- Reuse Logo Component -->
            <x-logo />

            <!-- Card Header -->
            <x-card-header class="text-2xl font-bold text-gray-800 text-center">{{ __('Register Now!') }}</x-card-header>

            <!-- Reuse Form Component -->
            <x-form :action="route('register')">

                <!-- Name Field -->
                <x-input type="text" name="name" label="Name" :value="old('name')" placeholder="Enter your name" required />

                <!-- Email Address Field -->
                <x-input type="email" name="email" label="Email Address" :value="old('email')" placeholder="Enter your email" required />

                <!-- Password Field -->
                <x-input type="password" name="password" label="Password" placeholder="Enter your password" required />

                <!-- Confirm Password Field -->
                <x-input type="password" name="password_confirmation" label="Confirm Password" placeholder="Confirm your password" required />

                <!-- Terms and Conditions Checkbox -->
                <div class="flex items-center space-x-2 mt-0">
                    <input type="checkbox" name="terms" id="terms" required class="form-checkbox h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label for="terms" class="block text-base text-gray-900">
                        {{ __('I accept the') }} <a href="#" class="text-blue-600 hover:underline">{{ __('Terms and Conditions') }}</a>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center mt-0">
                    <x-button class="w-full py-3 px-6 bg-gradient-to-r from-blue-500 to-green-500 text-white font-semibold text-lg rounded-lg shadow-md hover:shadow-xl transition duration-300 ease-in-out">
                        {{ __('Register') }}
                    </x-button>
                </div>

            </x-form>

            <!-- Log In Link -->
            <div class="text-center mt-6">
                <p class="text-base text-gray-600">Already registered with us? <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-800 transition duration-300 ease-in-out">Log In</a></p>
            </div>
        </div>
    </div>
@endsection
