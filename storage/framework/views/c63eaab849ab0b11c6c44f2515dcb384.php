<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['type' => 'text', 'name', 'label', 'value' => '', 'placeholder' => '', 'autocomplete' => '', 'errors']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['type' => 'text', 'name', 'label', 'value' => '', 'placeholder' => '', 'autocomplete' => '', 'errors']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div>
    <!-- Label -->
    <label for="<?php echo e($name); ?>" class="text-lg font-medium text-gray-700"><?php echo e($label); ?></label>

    <!-- Input Field -->
    <input
        id="<?php echo e($name); ?>"
        type="<?php echo e($type); ?>"
        name="<?php echo e($name); ?>"
        value="<?php echo e(old($name, $value)); ?>"
        placeholder="<?php echo e($placeholder); ?>"
        class="mt-1 mb-0 block w-full px-3 py-2 rounded-md shadow-sm text-base
               <?php echo e($errors->has($name) ? 'border-2 border-red-500 focus:ring-red-500' : 'border-gray-500 focus:ring-indigo-500'); ?>"
        autocomplete="<?php echo e($autocomplete); ?>"
        oninput="removeAllErrorStyles()"
    >

    <!-- Error Message -->
    <?php if($errors->has($name)): ?>
        <span id="<?php echo e($name); ?>-error" class="text-red-500 text-sm" role="alert">
            <strong><?php echo e($errors->first($name)); ?></strong>
        </span>
    <?php endif; ?>
</div>

<!-- Inline Script to Reset Error Styles -->
<script>
    function removeAllErrorStyles() {
        // Get all input fields and error messages
        const inputFields = document.querySelectorAll('input');
        const errorMessages = document.querySelectorAll('[id$="-error"]');

        // Loop through input fields and reset their styles
        inputFields.forEach(input => {
            input.classList.remove('border-red-500', 'focus:ring-red-500'); // Remove error styles
            input.classList.add('border-gray-500', 'focus:ring-indigo-500'); // Add default styles
        });

        // Loop through all error messages and hide them
        errorMessages.forEach(errorMessage => {
            errorMessage.style.display = 'none';
        });
    }
</script>
<?php /**PATH D:\e-commerce\tarpor\resources\views/components/input.blade.php ENDPATH**/ ?>