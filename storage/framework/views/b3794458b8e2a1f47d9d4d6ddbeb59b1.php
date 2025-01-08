<?php $__env->startSection('content'); ?>
    <!-- Full Screen Container with Gradient Background -->
    <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-gray-200 via-gray-300 to-gray-500">
        <div class="bg-white p-8 rounded-xl shadow-xl w-full max-w-md space-y-6 transform transition-all duration-500 hover:shadow-2xl">
            <!-- Display logo if required -->
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

            <!-- Card Header -->
            <?php if (isset($component)) { $__componentOriginal45b0c9ba26fcd16a79034c21758ffbac = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal45b0c9ba26fcd16a79034c21758ffbac = $attributes; } ?>
<?php $component = App\View\Components\CardHeader::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\CardHeader::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-2xl font-bold text-gray-800 text-center']); ?><?php echo e(__('Request OTP for Password Reset')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal45b0c9ba26fcd16a79034c21758ffbac)): ?>
<?php $attributes = $__attributesOriginal45b0c9ba26fcd16a79034c21758ffbac; ?>
<?php unset($__attributesOriginal45b0c9ba26fcd16a79034c21758ffbac); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal45b0c9ba26fcd16a79034c21758ffbac)): ?>
<?php $component = $__componentOriginal45b0c9ba26fcd16a79034c21758ffbac; ?>
<?php unset($__componentOriginal45b0c9ba26fcd16a79034c21758ffbac); ?>
<?php endif; ?>

            <!-- Success Message -->
            <?php if(session('status')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>

            <!-- Request OTP Form -->
            <?php if (isset($component)) { $__componentOriginal18ad2e0d264f9740dc73fff715357c28 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18ad2e0d264f9740dc73fff715357c28 = $attributes; } ?>
<?php $component = App\View\Components\Form::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Form::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('otp.password.request'))]); ?>
                <!-- Email Input Field -->
                <?php if (isset($component)) { $__componentOriginal786b6632e4e03cdf0a10e8880993f28a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal786b6632e4e03cdf0a10e8880993f28a = $attributes; } ?>
<?php $component = App\View\Components\Input::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'email','name' => 'email','label' => 'Email Address','placeholder' => 'Enter your email','required' => true]); ?>
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

                <!-- Buttons Row -->
                <div class="flex space-x-4 mt-6">
                    <!-- Send OTP Button -->
                    <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-full md:w-1/2 py-3 px-6 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-300 ease-in-out transform hover:scale-105 flex justify-center items-center']); ?>
                        <?php echo e(__('Send OTP')); ?>

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

                    <!-- Back Button -->
                    <a href="<?php echo e(route('login')); ?>"
                       class="w-full md:w-1/2 py-3 px-6 bg-white text-gray-800 font-semibold rounded-lg border-2 border-gray-300 shadow-md hover:bg-gray-100 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 transition duration-300 ease-in-out transform hover:scale-105 flex justify-center items-center">
                        <?php echo e(__('Back')); ?>

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
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\e-commerce\tarpor\resources\views/auth/passwords/email.blade.php ENDPATH**/ ?>