@props([
    'icon' => null,
    'value',
])
<a {{ $attributes->merge(['class' => 'text-capitalize mx-1 btn']) }}>
    @if ($icon)
        <i class="{{ $icon }}"></i>
    @endif
    {{ $value ?? $slot }}
</a>
