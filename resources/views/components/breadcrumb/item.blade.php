@props([
    'value' => 'dashboard',
])
<li class="breadcrumb-item">
    <a {{ $attributes->merge(['class' => 'text-reset text-decoration-none']) }}>
        {{ $value ?? $slot }}
    </a>
</li>
