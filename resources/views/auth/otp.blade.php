@extends('layouts.auth')

@section('content')
    <!-- Main Container -->
    <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-purple-400 via-pink-500 to-red-500">
        <!-- Card for OTP Form -->
        <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md space-y-6">

            <!-- Reuse Logo Component -->

            <!-- OTP Verification Header -->
            <x-card-header class="text-2xl font-bold text-gray-700">{{ __('Verify OTP') }}</x-card-header>

            <!-- Reuse Form Component -->
            <x-form :action="route('otp.verify')">
                <!-- Hidden Email Address Field -->
                <input type="hidden" name="email" id="userEmail" value="{{ Auth::user()->email }}" />

                <!-- OTP Field (using Input Component) -->
                <x-input type="text" name="otp" label="OTP" placeholder="Enter the OTP" required />

                <!-- Countdown Timer (Styled) -->
                <div class="text-center mb-4">
                    <span class="text-lg font-semibold text-gray-600">You can resend OTP in</span>
                    <span id="countdown" class="font-bold text-red-500 text-lg"></span>
                </div>

                <!-- Buttons: Verify OTP and Resend OTP -->
                <div class="flex justify-between items-center mt-4 space-x-4">
                    <!-- Verify OTP Button -->
                    <button class="w-full py-2 px-4 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-semibold rounded-lg shadow-md transition ease-in-out duration-300">
                        {{ __('Verify OTP') }}
                    </button>

                    <!-- Resend OTP Button -->
                    <button type="button" id="resendOtpButton" class="w-full py-2 px-4 bg-gradient-to-r from-gray-300 to-gray-500 text-gray-500 rounded-lg cursor-not-allowed transition ease-in-out duration-300 shadow-md" disabled>
                        {{ __('Resend OTP') }}
                    </button>
                </div>
            </x-form>

            <!-- Hidden Form for Resending OTP -->
            <form method="POST" action="{{ route('otp.resend') }}" id="hiddenResendOtpForm" style="display:none;">
                @csrf
                <!-- Hidden Email Field -->
                <input type="hidden" name="email" value="{{ Auth::user()->email }}">
            </form>

            <!-- Sign Up Link -->
            <div class="text-center mt-6">
                <p class="text-sm text-gray-600">Not a member? <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">Register Now!</a></p>
            </div>
        </div>
    </div>

    <!-- Countdown and Resend OTP Logic -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var countdownTime = 300; // 3 seconds for testing, change to 300 (5 minutes) as needed
            var countdownElement = document.getElementById('countdown');
            var resendOtpButton = document.getElementById('resendOtpButton');
            var hiddenResendOtpForm = document.getElementById('hiddenResendOtpForm'); // Hidden form reference

            function updateCountdown() {
                var minutes = Math.floor(countdownTime / 60);
                var seconds = countdownTime % 60;
                countdownElement.textContent = minutes + "m " + (seconds < 10 ? "0" : "") + seconds + "s";

                countdownTime--;

                // If countdown is over, enable the Resend OTP button
                if (countdownTime < 0) {
                    clearInterval(countdownInterval);
                    countdownElement.textContent = "Expired";
                    resendOtpButton.disabled = false; // Enable the button
                    resendOtpButton.classList.remove('bg-gray-300', 'cursor-not-allowed', 'text-gray-500');
                    resendOtpButton.classList.add('bg-gradient-to-r', 'from-green-400', 'to-green-600', 'hover:from-green-500', 'hover:to-green-700', 'text-white');
                }
            }

            // Start the countdown
            var countdownInterval = setInterval(updateCountdown, 1000);

            // Handle the Resend OTP button click to submit the hidden form
            resendOtpButton.addEventListener('click', function (event) {
                if (!resendOtpButton.disabled) {
                    hiddenResendOtpForm.submit(); // Submit the hidden form when Resend OTP is clicked
                }
            });
        });
    </script>
@endsection
