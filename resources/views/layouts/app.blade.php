<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- Include the head component -->

    <x-head/>

    <body class="gradient-bg">
        <x-icons/>

        <x-header/>

        <!-- Main content -->
        @yield('content')


    <x-footer/>

    </body>
</html>

