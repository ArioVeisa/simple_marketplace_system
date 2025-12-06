@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-medium text-dark-300 mb-2']) }}>
    {{ $value ?? $slot }}
</label>
