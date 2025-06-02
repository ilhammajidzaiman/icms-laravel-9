@props(['value'])
<label {{ $attributes->merge(['class' => 'form-check-label']) }}>
    {{ $value ?? $slot }}
</label>
