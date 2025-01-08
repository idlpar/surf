<nav class="bg-gray-800">
    <div class="container mx-auto flex justify-between items-center h-16 px-4 sm:px-6 lg:px-8">
        <!-- Logo and Brand -->
        <a href="<?php echo e(url('/')); ?>" class="flex items-center space-x-2">
            <img src="<?php echo e(asset('logos/tblue.svg')); ?>?v=1.0" alt="Logo" class="h-8 w-8">
            <span class="font-semibold text-lg text-white"><?php echo e(config('app.name', 'Laravel')); ?></span>
        </a>

        <!-- Hamburger Button (For Mobile) -->
        <button @click="isOpen = !isOpen" class="md:hidden text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>

        <!-- Navbar Links -->
        <div :class="{ 'block': isOpen, 'hidden': !isOpen }" class="hidden md:flex md:items-center md:space-x-4">
            <!-- Left Side Of Navbar -->
            <ul class="flex space-x-4">
                <a href="/" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Home</a>
                <a href="/" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">About</a>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="flex space-x-4 items-center">
                <!-- Authentication Links -->
                <?php if(auth()->guard()->guest()): ?>
                    <?php if(Route::has('login')): ?>
                        <li>
                            <a class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                        </li>
                    <?php endif; ?>

                    <?php if(Route::has('register')): ?>
                        <li>
                            <a class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>
                        </li>
                    <?php endif; ?>
                <?php else: ?>
                    <!-- Profile Dropdown -->
                    <li class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="text-gray-300 hover:text-white flex items-center focus:outline-none">
                            <?php echo e(Auth::user()->name); ?>

                            <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div
                            x-show="open"
                            @click.away="open = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-gray-100 py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu"
                            aria-orientation="vertical"
                            aria-labelledby="user-menu-button"
                            style="display: none;"
                        >
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-amber-300 hover:text-gray-900" role="menuitem" id="user-menu-item-0">Your Profile</a>
                            <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-amber-300 hover:text-gray-900" href="<?php echo e(route('logout')); ?>"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <?php echo e(__('Logout')); ?>

                            </a>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="hidden">
                                <?php echo csrf_field(); ?>
                            </form>
                        </div>





















                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <!-- Mobile menu, hidden by default -->
    <div :class="{ 'block': isOpen, 'hidden': !isOpen }" class="md:hidden">
        <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
            <a href="/" class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white">Home</a>
            <a href="/" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">About</a>
        </div>
    </div>
</nav>
<?php /**PATH D:\e-commerce\tarpor\resources\views/components/nav-link.blade.php ENDPATH**/ ?>