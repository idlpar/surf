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
{{--    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'>--}}

    <!-- CSS Stylesheets -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
<style>
    div.snize-ac-results li.snize-label {
        display:block;
        padding:5px 10px 5px;
        color:#006a4e;
        text-align:left;
        text-transform:uppercase;
        font-size:12px;
        font-weight:bold;
        line-height:14px;
        border-top:1px solid #eee;
        border-bottom:1px solid #eee;
        background:#f7f7f7;
        cursor:auto
    }
    div.snize-ac-results li {
        border-top:1px solid transparent;
        border-bottom:1px solid transparent;
        line-height:16px;
        padding:4px 10px 4px 10px
    }
    div.snize-ac-results li.snize-category a.snize-view-link {
        display:block;
        color:#0288d1;
        font-weight:700;
        font-size:100%
    }
    div.snize-ac-results li {
        border-top:1px solid transparent;
        border-bottom:1px solid transparent;
        line-height:16px;
        padding:4px 10px 4px 10px
    }
    .view-all li {
        text-align:right;
        border-top: 1px solid #eee!important;
        background: #f7f7f7;
    }
    div.snize-ac-results a.snize-item {
        clear:both;
        display:block;
        padding:2px;
        min-height:60px;
        outline:0;
        opacity:1;
        text-decoration:none
    }
    div.snize-ac-results a.clearfix:after,
    div.snize-ac-results a.clearfix:before {
        display:block;
        visibility:hidden;
        overflow:hidden;
        width:0;
        height:0;
        content:"\0020"
    }
    div.snize-ac-results span.snize-thumbnail {
        display:block;
        float:left;
        margin:5px 10px 5px 0;
        text-align:center;
        width:70px
    }
    div.snize-ac-results span.snize-overhidden {
        display:block;
        overflow:hidden
    }
    div.snize-ac-results span.snize-thumbnail img {
        display:inline
    }
    div.snize-ac-results span.snize-title {
        display:block;
        color:#0288d1;
        font-weight:700;
        font-size:100%;
        margin-top:3px;
        overflow:hidden;
        white-space:nowrap;
        text-overflow:ellipsis
    }
    div.snize-ac-results span.snize-description {
        display:block;
        margin-top:5px;
        color:#747474;
        overflow:hidden;
        white-space:nowrap;
        text-overflow:ellipsis
    }
    div.snize-ac-results .snize-price-list {
        float:left;
        margin-top:6px;
        color:#014e70;
        font-weight:700;
        font-size:115%
    }
    div.snize-ac-results li.snize-ac-over-nodrop,
    div.snize-ac-results li.snize-ac-over-nodrop a.snize-view-link:hover {
        background-color:#f7f7f7
    }
    li.snize-all:hover,
    li.snize-category:hover,
    li.snize-product:hover,
    li.snize-suggestion:hover {
        background:#f7f7f7
    }
    .search-with-box {
        position:relative
    }
    .product-home-card .card:hover .container__wrapper4,
    .product-home-card .card:hover .container__wrapper3 {
        display:none
    }
    .emi-table th,
    .emi-table td {
        color:#fff!important;
        font-size:13px!important
    }
</style>
