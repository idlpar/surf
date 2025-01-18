@extends('layouts.auth')

@section('content')
    <!-- Main Container with Professional Gradient Background -->
    <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-indigo-50 via-gray-100 to-blue-100">
        <!-- Card for Email Verification -->
        <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md space-y-6 transform transition-all duration-500 hover:shadow-2xl">

            <!-- Reuse Logo Component -->
     
            <!-- Verify Email Header -->
            <x-card-header class="text-2xl font-bold text-gray-800 text-center">{{ __('Verify Your Email Address') }}</x-card-header>

            <div class="card-body text-gray-700">
                <!-- Success Message -->
                @if (session('resent'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif

                <p>{{ __('Before proceeding, please check your email for a verification link.') }}</p>
                <p>{{ __('If you did not receive the email') }},</p>

                <!-- Resend Verification Form -->
                <x-form :action="route('verification.resend')" class="inline">
                    @csrf
                    <x-button type="submit" class="text-blue-600 hover:text-blue-800 p-0 m-0 align-baseline font-semibold">
                        {{ __('Click here to request another') }}
                    </x-button>
                </x-form>
            </div>
        </div>
    </div>
@endsection
