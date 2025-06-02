@props([
    // 'class' => 'text-secondary link-secondary link-underline-opacity-0 link-underline-opacity-100-hover',
    'icon' => null,
    'value',
])
<a {{ $attributes->merge(['class' => null]) }}>
    @if ($icon)
        <i class="{{ $icon }}"></i>
    @endif
    {{ $value ?? $slot }}
</a>
