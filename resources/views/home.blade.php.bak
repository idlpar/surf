@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex justify-center items-center bg-gradient-to-r from-blue-500 to-purple-600">
        <div class="w-full max-w-3xl bg-white shadow-xl rounded-xl overflow-hidden">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-700 text-white py-6 text-center">
                <h2 class="text-3xl font-bold">{{ __('Dashboard') }}</h2>
            </div>

            <!-- Card Body -->
            <div class="p-8">
                @if (session('status'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg">
                        <p class="font-semibold">{{ session('status') }}</p>
                    </div>
                @endif

                <div class="text-center">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-4">{{ __('Welcome back!') }}</h3>
                    <p class="text-gray-600">{{ __('You are logged in!') }}</p>

                    <div class="mt-6">
                        <a href="{{ route('home') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow-lg hover:bg-blue-700 transition duration-300">
                            {{ __('Go to Dashboard') }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card Footer -->
            <div class="bg-gray-50 py-4 text-center">
                <p class="text-gray-500">{{ __('Need help?') }} <a href="#" class="text-blue-600 hover:underline">{{ __('Contact Support') }}</a></p>
            </div>
        </div>
    </div>
@endsection
