@props([
    'type' => null,
    'icon' => null,
    'value',
])
<button type="{{ $type ?? null }}" {{ $attributes->merge(['class' => 'text-capitalize btn btn-primary']) }}>
    @if ($icon)
        <i class="{{ $icon }}"></i>
    @endif
    {{ $value ?? null }}
</button>
