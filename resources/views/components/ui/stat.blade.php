@props([
    'label',
    'value',
    'icon' => 'task_alt',
    'tone' => 'brand',
])

@php
    $tonos = [
        'brand' => 'bg-brand-50 text-brand-700',
        'warning' => 'bg-warning-50 text-warning-700',
        'progress' => 'bg-brand-50 text-brand-600',
        'success' => 'bg-success-50 text-success-700',
        'muted' => 'bg-canvas text-muted',
    ];
@endphp

<div {{ $attributes->merge(['class' => 'flex items-center gap-3 bg-surface px-4 py-5 sm:px-5']) }}>
    <span class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl {{ $tonos[$tone] ?? $tonos['brand'] }}"
          aria-hidden="true">
        <span class="material-symbols-outlined text-[20px]" aria-hidden="true" focusable="false">{{ $icon }}</span>
    </span>

    <div class="min-w-0">
        <p class="text-xs font-medium text-muted">{{ $label }}</p>
        <p class="mt-0.5 font-display text-3xl leading-none text-ink tabular-nums">{{ $value }}</p>
    </div>
</div>
