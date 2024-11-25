@props(['action'])

<form method="POST" action="{{ $action }}" class="bg-gradient-to-br from-gray-50 via-gray-100 to-gray-100 p-6 rounded-lg shadow-lg w-full max-w-md space-y-6">
    @csrf
    {{ $slot }}
</form>

