@props([
    'href' => null,
    'variant' => 'primary',
    'type' => 'button',
])

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => 'btn btn-'.$variant.' d-inline-flex align-items-center gap-2']) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => 'btn btn-'.$variant.' d-inline-flex align-items-center gap-2']) }}>
        {{ $slot }}
    </button>
@endif
