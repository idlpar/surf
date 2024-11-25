@props(['type' => 'text', 'name', 'label', 'value' => '', 'placeholder' => '', 'autocomplete' => '', 'errors'])

<div>
    <label for="{{ $name }}" class="text-lg font-medium text-gray-700">{{ $label }}</label>
    <input
        id="{{ $name }}"
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        class="mt-1 mb-0 block w-full px-3 py-2 rounded-md shadow-sm text-base  {{ $errors->has($name) ? 'border-2 border-red-500 focus:ring-red-500' : 'border-gray-500 focus:ring-indigo-500' }}"
        autocomplete="{{ $autocomplete }}"

    >
    @if ($errors->has($name))
        <span class="text-red-500 text-sm" role="alert">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
</div>
