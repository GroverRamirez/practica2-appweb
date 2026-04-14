@props([
    'value' => null,
    'variant' => null,
])

@php
    $normalized = strtolower((string) ($value ?? trim($slot)));
    $resolvedVariant = $variant;

    if ($resolvedVariant === null) {
        $resolvedVariant = match ($normalized) {
            'activo' => 'success',
            'inactivo' => 'secondary',
            default => 'dark',
        };
    }
@endphp

<span {{ $attributes->merge(['class' => 'badge text-bg-'.$resolvedVariant.' rounded-pill px-3 py-2']) }}>
    {{ $value ?? trim($slot) }}
</span>
