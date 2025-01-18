<?php $__env->startSection('content'); ?>
    <!-- Main Container -->
    <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-purple-400 via-pink-500 to-red-500">
        <!-- Card for OTP Form -->
        <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md space-y-6">

            <!-- Reuse Logo Component -->
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

            <!-- OTP Verification Header -->
            <?php if (isset($component)) { $__componentOriginal45b0c9ba26fcd16a79034c21758ffbac = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal45b0c9ba26fcd16a79034c21758ffbac = $attributes; } ?>
<?php $component = App\View\Components\CardHeader::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\CardHeader::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-2xl font-bold text-gray-700']); ?><?php echo e(__('Verify OTP')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal45b0c9ba26fcd16a79034c21758ffbac)): ?>
<?php $attributes = $__attributesOriginal45b0c9ba26fcd16a79034c21758ffbac; ?>
<?php unset($__attributesOriginal45b0c9ba26fcd16a79034c21758ffbac); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal45b0c9ba26fcd16a79034c21758ffbac)): ?>
<?php $component = $__componentOriginal45b0c9ba26fcd16a79034c21758ffbac; ?>
<?php unset($__componentOriginal45b0c9ba26fcd16a79034c21758ffbac); ?>
<?php endif; ?>

            <!-- Reuse Form Component -->
            <?php if (isset($component)) { $__componentOriginal18ad2e0d264f9740dc73fff715357c28 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18ad2e0d264f9740dc73fff715357c28 = $attributes; } ?>
<?php $component = App\View\Components\Form::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Form::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('otp.verify'))]); ?>
                <!-- Hidden Email Address Field -->
                <input type="hidden" name="email" id="userEmail" value="<?php echo e(Auth::user()->email); ?>" />

                <!-- OTP Field (using Input Component) -->
                <?php if (isset($component)) { $__componentOriginal786b6632e4e03cdf0a10e8880993f28a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal786b6632e4e03cdf0a10e8880993f28a = $attributes; } ?>
<?php $component = App\View\Components\Input::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Input::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'otp','label' => 'OTP','placeholder' => 'Enter the OTP','required' => true]); ?>
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

                <!-- Countdown Timer (Styled) -->
                <div class="text-center mb-4">
                    <span class="text-lg font-semibold text-gray-600">You can resend OTP in</span>
                    <span id="countdown" class="font-bold text-red-500 text-lg"></span>
                </div>

                <!-- Buttons: Verify OTP and Resend OTP -->
                <div class="flex justify-between items-center mt-4 space-x-4">
                    <!-- Verify OTP Button -->
                    <button class="w-full py-2 px-4 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-semibold rounded-lg shadow-md transition ease-in-out duration-300">
                        <?php echo e(__('Verify OTP')); ?>

                    </button>

                    <!-- Resend OTP Button -->
                    <button type="button" id="resendOtpButton" class="w-full py-2 px-4 bg-gradient-to-r from-gray-300 to-gray-500 text-gray-500 rounded-lg cursor-not-allowed transition ease-in-out duration-300 shadow-md" disabled>
                        <?php echo e(__('Resend OTP')); ?>

                    </button>
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

            <!-- Hidden Form for Resending OTP -->
            <form method="POST" action="<?php echo e(route('otp.resend')); ?>" id="hiddenResendOtpForm" style="display:none;">
                <?php echo csrf_field(); ?>
                <!-- Hidden Email Field -->
                <input type="hidden" name="email" value="<?php echo e(Auth::user()->email); ?>">
            </form>

            <!-- Sign Up Link -->
            <div class="text-center mt-6">
                <p class="text-sm text-gray-600">Not a member? <a href="<?php echo e(route('register')); ?>" class="font-medium text-indigo-600 hover:text-indigo-500">Register Now!</a></p>
            </div>
        </div>
    </div>

    <!-- Countdown and Resend OTP Logic -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var countdownTime = 300; // 3 seconds for testing, change to 300 (5 minutes) as needed
            var countdownElement = document.getElementById('countdown');
            var resendOtpButton = document.getElementById('resendOtpButton');
            var hiddenResendOtpForm = document.getElementById('hiddenResendOtpForm'); // Hidden form reference

            function updateCountdown() {
                var minutes = Math.floor(countdownTime / 60);
                var seconds = countdownTime % 60;
                countdownElement.textContent = minutes + "m " + (seconds < 10 ? "0" : "") + seconds + "s";

                countdownTime--;

                // If countdown is over, enable the Resend OTP button
                if (countdownTime < 0) {
                    clearInterval(countdownInterval);
                    countdownElement.textContent = "Expired";
                    resendOtpButton.disabled = false; // Enable the button
                    resendOtpButton.classList.remove('bg-gray-300', 'cursor-not-allowed', 'text-gray-500');
                    resendOtpButton.classList.add('bg-gradient-to-r', 'from-green-400', 'to-green-600', 'hover:from-green-500', 'hover:to-green-700', 'text-white');
                }
            }

            // Start the countdown
            var countdownInterval = setInterval(updateCountdown, 1000);

            // Handle the Resend OTP button click to submit the hidden form
            resendOtpButton.addEventListener('click', function (event) {
                if (!resendOtpButton.disabled) {
                    hiddenResendOtpForm.submit(); // Submit the hidden form when Resend OTP is clicked
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\e-commerce\tarpor\resources\views/auth/otp.blade.php ENDPATH**/ ?>