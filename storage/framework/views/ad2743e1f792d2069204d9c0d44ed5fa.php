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
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <!-- Page Title -->
    <title>Tarpor | <?php echo $__env->yieldContent('title', 'Shop Online, Save Time'); ?></title>


    <!-- Favicon and Icons -->
    <link rel="shortcut icon" type="image/svg+xml" href="<?php echo e(asset('logos/tred.svg')); ?>?v=1.0" />
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('logos/tred.svg')); ?>?v=1.0">
    <link rel="icon" sizes="192x192" href="<?php echo e(asset('logos/tred.svg')); ?>?v=1.0">

    <!-- Open Graph (OG) Meta Tags for Social Sharing -->
    <meta property="og:title" content="<?php echo e(config('app.name', 'T A R P O R')); ?>">
    <meta property="og:description" content="A short description of the page for social media sharing.">
    <meta property="og:image" content="<?php echo e(asset('logos/tred.svg')); ?>?v=1.0">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <meta property="og:type" content="website">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo e(config('app.name', 'T A R P O R')); ?>">
    <meta name="twitter:description" content="A short description for Twitter sharing.">
    <meta name="twitter:image" content="<?php echo e(asset('logos/tred.svg')); ?>?v=1.0">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Allura&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jost:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sofia&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">



    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js']); ?>

    <!-- Include your stylesheets here -->
    <?php echo $__env->yieldPushContent('styles'); ?>
        <link rel="stylesheet" href="<?php echo e(asset('css/fonts.css')); ?>" type="text/css">
        <link rel="stylesheet" href="<?php echo e(asset('css/plugins/swiper.min.css')); ?>" type="text/css" />
        <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/custom.css')); ?>">
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"></script>

</head>


<?php /**PATH D:\e-commerce\tarpor\resources\views/components/head.blade.php ENDPATH**/ ?>