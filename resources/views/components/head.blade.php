<head>
    <!-- Meta Information -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="author" content="Parvez Ahmed">
    <meta name="robots" content="index, follow">

    <!-- SEO Meta Tags -->
    <meta name="description" content="TARPOR is a cutting-edge platform providing innovative solutions for businesses and individuals alike. Join us to revolutionize the way you work and interact with technology.">
    <meta name="keywords" content="TARPOR, business solutions, innovation, technology, productivity, platform, tarpor.com">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Page Title -->
    <title>Tarpor | @yield('title', 'Shop Online, Save Time')</title>

    <!-- Favicon and Icons -->
    <link rel="icon" type="image/svg+xml" sizes="any" href="{{ asset('logos/tred.svg') }}?v=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logos/tred.svg') }}?v=1.0">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('logos/tred.svg') }}?v=1.0">

    <!-- Open Graph (OG) Meta Tags for Social Sharing -->
    <meta property="og:title" content="{{ config('app.name', 'T A R P O R') }}">
    <meta property="og:description" content="TARPOR provides innovative business solutions to boost productivity and streamline technology interactions.">
    <meta property="og:image" content="{{ asset('logos/tred.svg') }}?v=1.0">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ config('app.name', 'T A R P O R') }}">
    <meta name="twitter:description" content="Explore TARPOR's innovative platform for technology-driven solutions.">
    <meta name="twitter:image" content="{{ asset('logos/tred.svg') }}?v=1.0">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Allura&family=Inter:wght@100..900&family=Jost:wght@100..900&family=Nunito:wght@200..1000&family=Roboto:wght@100..900&family=Sofia&display=swap" rel="stylesheet">

    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- CSS Stylesheets -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/plugins/swiper.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" type="text/css">

    @stack('styles') <!-- Stack for additional styles -->

    <!-- Scripts -->
    {{-- Uncomment and configure below for Laravel Vite --}}
    {{-- @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js']) --}}

    <!-- Conditional Comments for Older IE Versions -->
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>


{{--<div id="app">--}}
