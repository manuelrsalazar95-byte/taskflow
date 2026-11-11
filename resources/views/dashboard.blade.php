@extends('layouts.app')

@section('title', 'Dashboard · TaskFlow')

@section('content')

@php
    $total = (int) $stats['total'];
    $completadas = (int) $stats['completadas'];
    $avance = $total > 0 ? (int) round(($completadas / $total) * 100) : 0;
@endphp

<div class="space-y-8">

    <x-ui.page-header
        eyebrow="Dashboard"
        :title="'Hola, '.Auth::user()->user_name.'.'"
        subtitle="Tus tareas, en orden. Esto es lo que hay hoy en tu escritorio."
        icon="dashboard"
    >
        <x-ui.button :href="route('tareas.index')" variant="secondary" size="md">
            <span class="material-symbols-outlined text-[18px]" aria-hidden="true" focusable="false">list</span>
            Ver tareas
        </x-ui.button>

        <x-ui.button :href="route('tareas.create')" variant="primary" size="md">
            <span class="material-symbols-outlined text-[18px]" aria-hidden="true" focusable="false">add</span>
            Nueva tarea
        </x-ui.button>
    </x-ui.page-header>

    {{-- Franja de métricas --}}
    <x-ui.card :padding="false" class="overflow-hidden">
        <div class="grid grid-cols-2 gap-px bg-line lg:grid-cols-4">
            <x-ui.stat
                label="Total de tareas"
                :value="$stats['total']"
                icon="task_alt"
                tone="brand"
            />

            <x-ui.stat
                label="Pendientes"
                :value="$stats['pendientes']"
                icon="schedule"
                tone="warning"
            />

            <x-ui.stat
                label="En progreso"
                :value="$stats['en_progreso']"
                icon="pending"
                tone="progress"
            />

            <x-ui.stat
                label="Completadas"
                :value="$stats['completadas']"
                icon="check_circle"
                tone="success"
            />
        </div>
    </x-ui.card>

    <div class="grid gap-6 lg:grid-cols-3">

        {{-- Tareas recientes --}}
        <x-ui.card :padding="false" class="overflow-hidden lg:col-span-2">
            <div class="flex items-center justify-between gap-4 border-b border-line px-5 py-4">
                <div>
                    <h2 class="text-sm font-semibold text-ink">Tareas recientes</h2>
                    <p class="mt-0.5 text-xs text-muted">Lo último que se movió en tu espacio.</p>
                </div>

                <a href="{{ route('tareas.index') }}"
                   class="flex items-center gap-1 rounded-lg px-2 py-1.5 text-sm font-medium text-brand-700 transition hover:bg-brand-50">
                    Ver todas
                    <span class="material-symbols-outlined text-[18px]" aria-hidden="true" focusable="false">arrow_forward</span>
                </a>
            </div>

            @if ($tareasRecientes->isEmpty())
                <x-ui.empty-state
                    icon="task_off"
                    title="Sin tareas recientes"
                    description="Cuando crees tu primera tarea aparecerá aquí, con su categoría y estado."
                >
                    <x-ui.button :href="route('tareas.create')" variant="primary" size="md">
                        Crear mi primera tarea
                    </x-ui.button>
                </x-ui.empty-state>
            @else
                <ul class="divide-y divide-line">
                    @foreach ($tareasRecientes as $tarea)
                        <li class="flex items-center justify-between gap-4 px-5 py-4 transition hover:bg-canvas/70">
                            <div class="min-w-0">
                                <a href="{{ route('tareas.edit', $tarea->id) }}"
                                   class="block truncate text-sm font-medium text-ink underline-offset-4 hover:underline">
                                    {{ $tarea->titulo }}
                                </a>

                                <p class="mt-0.5 truncate text-xs text-muted">
                                    {{ $tarea->categoria->name ?? 'Sin categoría' }}
                                </p>
                            </div>

                            <x-ui.badge :estado="$tarea->estado" class="flex-shrink-0" />
                        </li>
                    @endforeach
                </ul>
            @endif
        </x-ui.card>

        {{-- Columna lateral --}}
        <div class="space-y-6">

            {{-- Avance --}}
            <x-ui.card>
                <div class="flex items-baseline justify-between gap-3">
                    <h2 class="text-sm font-semibold text-ink">Avance</h2>
                    <p class="font-display text-3xl leading-none text-ink tabular-nums">{{ $avance }}%</p>
                </div>

                <div class="mt-4 h-2 overflow-hidden rounded-full bg-canvas"
                     role="progressbar"
                     aria-label="Tareas completadas sobre el total"
                     aria-valuemin="0"
                     aria-valuemax="100"
                     aria-valuenow="{{ $avance }}">
                    <div class="h-full rounded-full bg-brand-600 transition-[width] duration-500" style="width: {{ $avance }}%"></div>
                </div>

                <p class="mt-3 text-xs leading-relaxed text-muted">
                    {{ $stats['completadas'] }} de {{ $stats['total'] }} tareas completadas.
                    @if ($stats['pendientes'] > 0)
                        Te quedan {{ $stats['pendientes'] }} pendientes.
                    @elseif ($total > 0)
                        No tienes tareas pendientes.
                    @else
                        Crea una tarea para empezar.
                    @endif
                </p>
            </x-ui.card>

            {{-- Accesos --}}
            <x-ui.card :padding="false" class="overflow-hidden">
                <div class="border-b border-line px-5 py-4">
                    <h2 class="text-sm font-semibold text-ink">Ir a</h2>
                </div>

                <nav aria-label="Accesos rápidos" class="divide-y divide-line">
                    <a href="{{ route('categorias.index') }}"
                       class="flex items-center gap-3 px-5 py-3.5 transition hover:bg-canvas">
                        <span class="material-symbols-outlined text-[20px] text-muted" aria-hidden="true" focusable="false">folder</span>
                        <span class="flex-1 text-sm font-medium text-ink">Categorías</span>
                        <span class="text-xs text-muted tabular-nums">{{ $stats['categorias'] }}</span>
                        <span class="material-symbols-outlined text-[18px] text-muted" aria-hidden="true" focusable="false">chevron_right</span>
                    </a>

                    <a href="{{ route('tareas.trash') }}"
                       class="flex items-center gap-3 px-5 py-3.5 transition hover:bg-canvas">
                        <span class="material-symbols-outlined text-[20px] text-muted" aria-hidden="true" focusable="false">delete_sweep</span>
                        <span class="flex-1 text-sm font-medium text-ink">Papelera</span>
                        <span class="text-xs text-muted tabular-nums">{{ $stats['papelera'] }}</span>
                        <span class="material-symbols-outlined text-[18px] text-muted" aria-hidden="true" focusable="false">chevron_right</span>
                    </a>

                    <a href="{{ route('tareas.create') }}"
                       class="flex items-center gap-3 px-5 py-3.5 transition hover:bg-canvas">
                        <span class="material-symbols-outlined text-[20px] text-muted" aria-hidden="true" focusable="false">add_task</span>
                        <span class="flex-1 text-sm font-medium text-ink">Nueva tarea</span>
                        <span class="material-symbols-outlined text-[18px] text-muted" aria-hidden="true" focusable="false">chevron_right</span>
                    </a>
                </nav>
            </x-ui.card>

        </div>
    </div>

</div>

@endsection
