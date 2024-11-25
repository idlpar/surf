<head>
    <!-- Meta Information -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="Parvez Ahmed" />
    <meta name="robots" content="index, follow">

    <!-- SEO Meta Tags -->
    <meta name="description" content="TARPOR is a cutting-edge platform providing innovative solutions for businesses and individuals alike. Join us to revolutionize the way you work and interact with technology.">
    <meta name="keywords" content="TARPOR, business solutions, innovation, technology, productivity, platform, tarpor.com">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Page Title -->
    <title>Tarpor | @yield('title', 'Shop Online, Save Time')</title>


    <!-- Favicon and Icons -->
    <link rel="shortcut icon" type="image/svg+xml" href="{{ asset('logos/tred.svg') }}?v=1.0" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logos/tred.svg') }}?v=1.0">
    <link rel="icon" sizes="192x192" href="{{ asset('logos/tred.svg') }}?v=1.0">

    <!-- Open Graph (OG) Meta Tags for Social Sharing -->
    <meta property="og:title" content="{{ config('app.name', 'T A R P O R') }}">
    <meta property="og:description" content="A short description of the page for social media sharing.">
    <meta property="og:image" content="{{ asset('logos/tred.svg') }}?v=1.0">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ config('app.name', 'T A R P O R') }}">
    <meta name="twitter:description" content="A short description for Twitter sharing.">
    <meta name="twitter:image" content="{{ asset('logos/tred.svg') }}?v=1.0">

    <!-- Fonts -->
    <link rel="preload" href="https://fonts.bunny.net/css?family=Nunito" as="style">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Allura&amp;display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js'])

    <!-- Include your stylesheets here -->
    @stack('styles')
    <link rel="stylesheet" href="{{ asset('css/plugins/swiper.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Jost&display=swap" rel="stylesheet">
</head>
{{--<body class="bg-gray-50">--}}
{{--<div id="app">--}}
