@props(['estado' => 'pendiente'])

@php
    $estilos = [
        'pendiente' => 'bg-warning-50 text-warning-700 ring-warning-200',
        'en_progreso' => 'bg-brand-50 text-brand-700 ring-brand-200',
        'completada' => 'bg-success-50 text-success-700 ring-success-200',
    ];

    $etiquetas = [
        'pendiente' => 'Pendiente',
        'en_progreso' => 'En progreso',
        'completada' => 'Completada',
    ];

    $clases = 'inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset '.($estilos[$estado] ?? 'bg-canvas text-muted ring-line');
@endphp

<span {{ $attributes->merge(['class' => $clases]) }}>
    <span class="h-1.5 w-1.5 rounded-full bg-current opacity-70" aria-hidden="true"></span>
    {{ $etiquetas[$estado] ?? $estado }}
</span>
