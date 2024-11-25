<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- Include the head component -->
<x-head/>
<body class="gradient-bg">

    <x-icons/>

    <x-mob-header/>

    <x-header/>
    <!-- Main content -->
    @yield('content')


    <x-footer/>

    <!-- Stack for pushing JavaScript files -->
    @stack('scripts')

</body>
</html>

