@props(['tarea'])

@php
    $estado = $tarea->estado;

    $tonos = [
        'pendiente' => 'border-warning-200 bg-warning-50 text-warning-700',
        'en_progreso' => 'border-brand-200 bg-brand-50 text-brand-700',
        'completada' => 'border-success-200 bg-success-50 text-success-700',
    ];

    $clases = 'w-full cursor-pointer appearance-none rounded-lg border py-1.5 pl-3 pr-8 text-xs font-semibold transition focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-100 lg:w-[140px] '
        .($tonos[$estado] ?? 'border-line bg-surface text-muted');
@endphp

<form action="{{ route('tareas.estado', $tarea->id) }}" method="POST" class="relative">
    @csrf
    @method('PATCH')

    <label for="estado-{{ $tarea->id }}" class="sr-only">
        Estado de la tarea «{{ $tarea->titulo }}»
    </label>

    <select
        id="estado-{{ $tarea->id }}"
        name="estado"
        data-auto-submit
        {{ $attributes->merge(['class' => $clases]) }}
    >
        <option value="pendiente" @selected($estado === 'pendiente')>Pendiente</option>
        <option value="en_progreso" @selected($estado === 'en_progreso')>En progreso</option>
        <option value="completada" @selected($estado === 'completada')>Completada</option>
    </select>

    <span class="material-symbols-outlined pointer-events-none absolute right-2.5 top-1/2 -translate-y-1/2 text-[16px] opacity-70"
          aria-hidden="true" focusable="false">expand_more</span>

    {{-- Sin JavaScript, la persona puede confirmar el cambio con este botón --}}
    <noscript>
        <button type="submit" class="mt-1 text-xs font-medium text-brand-700 underline">Actualizar</button>
    </noscript>
</form>
