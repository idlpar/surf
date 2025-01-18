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
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <!-- Page Title -->
    <title>Tarpor | <?php echo $__env->yieldContent('title', 'Shop Online, Save Time'); ?></title>

    <!-- Favicon and Icons -->
    <link rel="icon" type="image/svg+xml" sizes="any" href="<?php echo e(asset('logos/tred.svg')); ?>?v=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('logos/tred.svg')); ?>?v=1.0">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo e(asset('logos/tred.svg')); ?>?v=1.0">

    <!-- Open Graph (OG) Meta Tags for Social Sharing -->
    <meta property="og:title" content="<?php echo e(config('app.name', 'T A R P O R')); ?>">
    <meta property="og:description" content="TARPOR provides innovative business solutions to boost productivity and streamline technology interactions.">
    <meta property="og:image" content="<?php echo e(asset('logos/tred.svg')); ?>?v=1.0">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <meta property="og:type" content="website">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo e(config('app.name', 'T A R P O R')); ?>">
    <meta name="twitter:description" content="Explore TARPOR's innovative platform for technology-driven solutions.">
    <meta name="twitter:image" content="<?php echo e(asset('logos/tred.svg')); ?>?v=1.0">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Allura&family=Inter:wght@100..900&family=Jost:wght@100..900&family=Nunito:wght@200..1000&family=Roboto:wght@100..900&family=Sofia&display=swap" rel="stylesheet">

    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- CSS Stylesheets -->
    <link rel="stylesheet" href="<?php echo e(asset('css/plugins/swiper.min.css')); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo e(asset('css/custom.css')); ?>" type="text/css">

    <?php echo $__env->yieldPushContent('styles'); ?> <!-- Stack for additional styles -->

    <!-- Scripts -->
    
    

    <!-- Conditional Comments for Older IE Versions -->
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>



<?php /**PATH D:\e-commerce\tarpor\resources\views/components/head.blade.php ENDPATH**/ ?>