@props(['type' => 'text', 'name', 'label', 'value' => '', 'placeholder' => '', 'autocomplete' => '', 'errors'])

<div>
    <!-- Label -->
    <label for="{{ $name }}" class="text-lg font-medium text-gray-700">{{ $label }}</label>

    <!-- Input Field -->
    <input
        id="{{ $name }}"
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        class="mt-1 mb-0 block w-full px-3 py-2 rounded-md shadow-sm text-base
               {{ $errors->has($name) ? 'border-2 border-red-500 focus:ring-red-500' : 'border-gray-500 focus:ring-indigo-500' }}"
        autocomplete="{{ $autocomplete }}"
        oninput="removeAllErrorStyles()"
    >

    <!-- Error Message -->
    @if ($errors->has($name))
        <span id="{{ $name }}-error" class="text-red-500 text-sm" role="alert">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
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
