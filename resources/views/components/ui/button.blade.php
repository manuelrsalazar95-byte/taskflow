@props([
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'submit',
    'href' => null,
])

@php
    $base = 'inline-flex items-center justify-center gap-2 rounded-xl font-medium transition-colors duration-150 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-60';

    $variants = [
        'primary' => 'bg-brand-600 text-white shadow-card hover:bg-brand-700 active:bg-brand-800',
        'secondary' => 'border border-field bg-surface text-ink shadow-card hover:bg-canvas active:bg-line/60',
        'ghost' => 'text-muted hover:bg-canvas hover:text-ink',
        'danger' => 'bg-danger-600 text-white hover:bg-danger-700 active:bg-danger-700',
        'danger-ghost' => 'text-danger-600 hover:bg-danger-50',
    ];

    $sizes = [
        'sm' => 'px-3 py-1.5 text-xs',
        'md' => 'px-4 py-2.5 text-sm',
        'lg' => 'px-5 py-3 text-sm',
    ];

    $classes = $base.' '.($variants[$variant] ?? $variants['primary']).' '.($sizes[$size] ?? $sizes['md']);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
