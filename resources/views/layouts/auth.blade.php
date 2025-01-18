<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta Information -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="author" content="Parvez Ahmed">
    <meta name="robots" content="index, follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Page Title -->
    <title>Tarpor | @yield('title', 'Shop Online, Save Time')</title>

    <!-- Favicon and Icons -->
    <link rel="icon" href="{{ asset('logos/tred.svg') }}" type="image/svg+xml">

    <!-- Open Graph and Twitter Meta Tags (Optional) -->
    <meta property="og:title" content="{{ config('app.name', 'T A R P O R') }}">
    <meta property="og:image" content="{{ asset('logos/tred.svg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ config('app.name', 'T A R P O R') }}">
    <meta name="twitter:image" content="{{ asset('logos/tred.svg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Allura&family=Inter:wght@100..900&family=Jost:wght@100..900&family=Nunito:wght@200..1000&family=Roboto:wght@100..900&family=Sofia&display=swap" rel="stylesheet">

    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- TailwindCSS -->
    @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Hide mobile menu by default */
        .mobile-menu {
            display: none;
        }

        /* Show mobile menu when active */
        .mobile-menu.active {
            display: block;
        }
    </style>
</head>

<body class="bg-gray-50">

<!-- Header Section -->
<header class="bg-gradient-to-r from-indigo-900 via-purple-800 to-indigo-900 py-8 shadow-2xl">
    <div class="container mx-auto flex justify-between items-center px-6 md:px-12">
        <!-- Logo Section on Left -->
        <div class="flex items-center space-x-6">
            <a href="{{ route('home') }}" class="text-4xl font-bold text-white hover:text-yellow-400 transition-all ease-in-out flex items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Tarpor Logo" class="max-w-[220px] max-h-14">
            </a>
        </div>

        <!-- Desktop Navigation Links -->
        <nav class="flex justify-center space-x-12 text-lg font-medium items-center mx-auto hidden md:flex">
            <a href="{{ route('home') }}" class="text-white hover:text-yellow-300 transition-all duration-300 ease-in-out">Home</a>
            <a href="{{ route('shop.index') }}" class="text-white hover:text-yellow-300 transition-all duration-300 ease-in-out">Shop</a>
            <a href="#about" class="text-white hover:text-yellow-300 transition-all duration-300 ease-in-out">About</a>
            <a href="#contact" class="text-white hover:text-yellow-300 transition-all duration-300 ease-in-out">Contact</a>
        </nav>

        <!-- Sign Up / Sign In Button on the Right -->
        <div class="flex items-center space-x-4 hidden md:flex">
            @if(Route::currentRouteName() == 'login')
                <a href="{{ route('register') }}" class="bg-yellow-400 text-black px-8 py-3 rounded-full text-lg font-semibold shadow-md hover:bg-yellow-500 hover:shadow-lg transition-all duration-300 ease-in-out transform hover:scale-105">
                    Sign Up
                </a>
            @elseif(Route::currentRouteName() == 'register')
                <a href="{{ route('login') }}" class="bg-yellow-400 text-black px-8 py-3 rounded-full text-lg font-semibold shadow-md hover:bg-yellow-500 hover:shadow-lg transition-all duration-300 ease-in-out transform hover:scale-105">
                    Sign In
                </a>
            @else
                <!-- Default: Show 'Sign Up' button -->
                <a href="{{ route('register') }}" class="bg-yellow-400 text-black px-8 py-3 rounded-full text-lg font-semibold shadow-md hover:bg-yellow-500 hover:shadow-lg transition-all duration-300 ease-in-out transform hover:scale-105">
                    Sign Up
                </a>
            @endif
        </div>


        <!-- Hamburger Menu Button (visible on mobile only) -->
        <div class="md:hidden flex items-center space-x-4">
            <button id="hamburger-icon" class="text-white focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>
</header>


<!-- Mobile Menu (Initially Hidden) -->
<!-- Mobile Menu (Professionally Styled) -->
<div class="mobile-menu fixed inset-0 bg-black bg-opacity-75 z-50 md:hidden">
    <!-- Close Button -->
    <div class="flex justify-end p-6">
        <button id="close-menu" class="text-yellow-100 text-3xl font-semibold">&times;</button>
    </div>
    <!-- Navigation Menu -->
    <div class="flex justify-center">
        <nav class="flex flex-col space-y-4 text-white text-lg w-full max-w-sm px-6">
            <!-- Home -->
            <a href="{{ route('home') }}"
               class="bg-gradient-to-r from-blue-600 to-blue-800 p-4 rounded-lg text-left shadow-md hover:bg-yellow-400 hover:shadow-lg transition-all duration-300 ease-in-out">
                Home
            </a>
            <!-- Shop -->
            <a href="{{ route('shop.index') }}"
               class="bg-gradient-to-r from-green-600 to-green-800 p-4 rounded-lg text-left shadow-md hover:bg-yellow-400 hover:shadow-lg transition-all duration-300 ease-in-out">
                Shop
            </a>
            <!-- About -->
            <a href="#about"
               class="bg-gradient-to-r from-indigo-600 to-indigo-800 p-4 rounded-lg text-left shadow-md hover:bg-yellow-400 hover:shadow-lg transition-all duration-300 ease-in-out">
                About
            </a>
            <!-- Contact -->
            <a href="#contact"
               class="bg-gradient-to-r from-teal-600 to-teal-800 p-4 rounded-lg text-left shadow-md hover:bg-yellow-400 hover:shadow-lg transition-all duration-300 ease-in-out">
                Contact
            </a>
        </nav>
    </div>
</div>



<!-- Hero Section -->
<section>
    @yield('content')
</section>

<!-- Footer Section -->
<footer class="bg-gradient-to-r from-purple-700 via-blue-600 to-teal-500 text-white py-6">
    <div class="container mx-auto flex flex-wrap justify-between items-center px-6">
        <!-- Left: Copyright -->
        <div class="text-sm mb-4 md:mb-0">
            <p>&copy; {{ date('Y') }} Tarpor. All Rights Reserved.</p>
        </div>

        <!-- Center: Social Media Icons -->
        <div class="flex space-x-6 text-xl mb-4 md:mb-0">
            <a href="#" class="text-white hover:text-yellow-400 transition duration-300">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="text-white hover:text-yellow-400 transition duration-300">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="text-white hover:text-yellow-400 transition duration-300">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="#" class="text-white hover:text-yellow-400 transition duration-300">
                <i class="fab fa-linkedin-in"></i>
            </a>
        </div>

        <!-- Right: Footer Links -->
        <div class="text-sm space-x-6 mb-4 md:mb-0">
            <a href="#" class="text-white hover:text-yellow-400 transition duration-300">Privacy Policy</a>
            <a href="#" class="text-white hover:text-yellow-400 transition duration-300">Terms of Service</a>
            <a href="#" class="text-white hover:text-yellow-400 transition duration-300">Contact</a>
        </div>
    </div>
</footer>

<!-- Scripts for Mobile Menu -->
<script>
    document.getElementById('hamburger-icon').addEventListener('click', function() {
        document.querySelector('.mobile-menu').classList.add('active');
    });

    document.getElementById('close-menu').addEventListener('click', function() {
        document.querySelector('.mobile-menu').classList.remove('active');
    });
</script>

</body>
</html>
