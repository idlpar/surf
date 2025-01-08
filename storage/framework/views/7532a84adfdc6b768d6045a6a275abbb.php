<?php $__env->startSection('content'); ?>
    <!-- Main Container -->
    <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-r from-blue-100 to-purple-200">
        <!-- Card for Login Form -->
        <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md space-y-6 transform transition-all duration-500 hover:shadow-2xl">

            <!-- Logo Component -->
            <?php if (isset($component)) { $__componentOriginale7dc1b8cfba3f7c6278ef1986decdec2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale7dc1b8cfba3f7c6278ef1986decdec2 = $attributes; } ?>
<?php $component = App\View\Components\Logo::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Logo::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale7dc1b8cfba3f7c6278ef1986decdec2)): ?>
<?php $attributes = $__attributesOriginale7dc1b8cfba3f7c6278ef1986decdec2; ?>
<?php unset($__attributesOriginale7dc1b8cfba3f7c6278ef1986decdec2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale7dc1b8cfba3f7c6278ef1986decdec2)): ?>
<?php $component = $__componentOriginale7dc1b8cfba3f7c6278ef1986decdec2; ?>
<?php unset($__componentOriginale7dc1b8cfba3f7c6278ef1986decdec2); ?>
<?php endif; ?>

            <!-- Sign In Header -->
            <?php if (isset($component)) { $__componentOriginal45b0c9ba26fcd16a79034c21758ffbac = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal45b0c9ba26fcd16a79034c21758ffbac = $attributes; } ?>
<?php $component = App\View\Components\CardHeader::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\CardHeader::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-2xl font-bold text-gray-800 text-center']); ?><?php echo e(__('Sign in to your account')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal45b0c9ba26fcd16a79034c21758ffbac)): ?>
<?php $attributes = $__attributesOriginal45b0c9ba26fcd16a79034c21758ffbac; ?>
<?php unset($__attributesOriginal45b0c9ba26fcd16a79034c21758ffbac); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal45b0c9ba26fcd16a79034c21758ffbac)): ?>
<?php $component = $__componentOriginal45b0c9ba26fcd16a79034c21758ffbac; ?>
<?php unset($__componentOriginal45b0c9ba26fcd16a79034c21758ffbac); ?>
<?php endif; ?>

            <!-- Login Form -->
            <?php if (isset($component)) { $__componentOriginal18ad2e0d264f9740dc73fff715357c28 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18ad2e0d264f9740dc73fff715357c28 = $attributes; } ?>
<?php $component = App\View\Components\Form::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Form::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('login'))]); ?>
                <!-- Email Field -->
                <?php if (isset($component)) { $__componentOriginal786b6632e4e03cdf0a10e8880993f28a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal786b6632e4e03cdf0a10e8880993f28a = $attributes; } ?>
<?php $component = App\View\Components\Input::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'email','name' => 'email','label' => 'Email address','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('email')),'placeholder' => 'Enter your email','autocomplete' => 'email','required' => true,'errors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal786b6632e4e03cdf0a10e8880993f28a)): ?>
<?php $attributes = $__attributesOriginal786b6632e4e03cdf0a10e8880993f28a; ?>
<?php unset($__attributesOriginal786b6632e4e03cdf0a10e8880993f28a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal786b6632e4e03cdf0a10e8880993f28a)): ?>
<?php $component = $__componentOriginal786b6632e4e03cdf0a10e8880993f28a; ?>
<?php unset($__componentOriginal786b6632e4e03cdf0a10e8880993f28a); ?>
<?php endif; ?>

                <!-- Password Field -->
                <?php if (isset($component)) { $__componentOriginal786b6632e4e03cdf0a10e8880993f28a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal786b6632e4e03cdf0a10e8880993f28a = $attributes; } ?>
<?php $component = App\View\Components\Input::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'password','name' => 'password','label' => 'Password','placeholder' => 'Enter your password','autocomplete' => 'current-password','required' => true,'errors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal786b6632e4e03cdf0a10e8880993f28a)): ?>
<?php $attributes = $__attributesOriginal786b6632e4e03cdf0a10e8880993f28a; ?>
<?php unset($__attributesOriginal786b6632e4e03cdf0a10e8880993f28a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal786b6632e4e03cdf0a10e8880993f28a)): ?>
<?php $component = $__componentOriginal786b6632e4e03cdf0a10e8880993f28a; ?>
<?php unset($__componentOriginal786b6632e4e03cdf0a10e8880993f28a); ?>
<?php endif; ?>

                <!-- Remember Me and Forgot Password -->
                <div class="flex items-center justify-between text-gray-600 mt-4">
                    <label class="inline-flex text-base items-center">
                        <input type="checkbox" id="remember" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?> class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <span class="ml-2 text-sm"><?php echo e(__('Remember me')); ?></span>
                    </label>
                    <a href="<?php echo e(route('password.request')); ?>" class="text-sm font-semibold text-blue-600 hover:text-blue-800">Forgot password?</a>
                </div>

                <!-- Sign In Button -->
                <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-full py-3 px-6 mt-6 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition duration-300 ease-in-out']); ?>
                    <?php echo e(__('Sign in')); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $attributes = $__attributesOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $component = $__componentOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__componentOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>

                <!-- Or Continue With Section -->
                <div class="relative mt-8 mb-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500">Or continue with</span>
                    </div>
                </div>

                <!-- Social Login Buttons -->
                <div class="grid grid-cols-2 gap-4">
                    <a href="<?php echo e(route('social.redirect', 'google')); ?>" class="flex items-center justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-md bg-white hover:bg-gray-50 transition transform hover:-translate-y-1 duration-300 ease-in-out">
                        <img src="<?php echo e(asset('logos/google.svg')); ?>" alt="Google" class="w-5 h-5 mr-2"> Google
                    </a>
                    <a href="<?php echo e(route('social.redirect', 'github')); ?>" class="flex items-center justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-md bg-white hover:bg-gray-50 transition transform hover:-translate-y-1 duration-300 ease-in-out">
                        <img src="<?php echo e(asset('logos/github.svg')); ?>" alt="GitHub" class="w-5 h-5 mr-2"> Github
                    </a>
                </div>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18ad2e0d264f9740dc73fff715357c28)): ?>
<?php $attributes = $__attributesOriginal18ad2e0d264f9740dc73fff715357c28; ?>
<?php unset($__attributesOriginal18ad2e0d264f9740dc73fff715357c28); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18ad2e0d264f9740dc73fff715357c28)): ?>
<?php $component = $__componentOriginal18ad2e0d264f9740dc73fff715357c28; ?>
<?php unset($__componentOriginal18ad2e0d264f9740dc73fff715357c28); ?>
<?php endif; ?>

            <!-- Sign Up Link -->
            <div class="text-center mt-8">
                <p class="text-base text-gray-600">Not a member? <a href="<?php echo e(route('register')); ?>" class="font-medium text-blue-600 hover:text-blue-800 transition duration-300 ease-in-out">Register Now!</a></p>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\e-commerce\tarpor\resources\views/auth/login.blade.php ENDPATH**/ ?>