@extends('layouts.app')

@section('title', 'Papelera de tareas · TaskFlow')

@section('content')

@php
    $pageTitle = \Illuminate\Support\Str::ucfirst(\Illuminate\Support\Str::lower($titulo));
    $pageDescription = \Illuminate\Support\Str::ucfirst(\Illuminate\Support\Str::lower($descripcion));
@endphp

<div class="space-y-6">

    <x-ui.page-header
        eyebrow="Sistema"
        :title="$pageTitle"
        :subtitle="$pageDescription.' Puedes restaurarlas o eliminarlas definitivamente.'"
        icon="delete_sweep"
    >
        <x-ui.button :href="route('tareas.index')" variant="secondary" size="md">
            <span class="material-symbols-outlined text-[18px]" aria-hidden="true" focusable="false">arrow_back</span>
            Volver a tareas
        </x-ui.button>
    </x-ui.page-header>

    <x-ui.card :padding="false" class="overflow-hidden">
        <div class="flex items-center justify-between gap-4 border-b border-line px-5 py-4">
            <div>
                <h2 class="text-sm font-semibold text-ink">Tareas en papelera</h2>
                <p class="mt-0.5 text-xs text-muted">
                    {{ $model->total() }} {{ $model->total() === 1 ? 'tarea' : 'tareas' }} eliminadas recientemente.
                </p>
            </div>
        </div>

        @if ($model->isEmpty())
            <x-ui.empty-state
                icon="delete_sweep"
                title="La papelera está vacía"
                description="No hay tareas eliminadas en este momento. Todo lo que archives aparecerá aquí."
            >
                <x-ui.button :href="route('tareas.index')" variant="secondary" size="md">
                    Volver a mis tareas
                </x-ui.button>
            </x-ui.empty-state>
        @else
            {{-- Cabecera de columnas (solo escritorio) --}}
            <div class="hidden grid-cols-[minmax(0,1fr)_150px_230px] gap-3 border-b border-line bg-canvas/60 px-5 py-2.5 lg:grid"
                 aria-hidden="true">
                <span class="text-xs font-medium text-muted">Tarea</span>
                <span class="text-xs font-medium text-muted">Eliminada el</span>
                <span class="text-right text-xs font-medium text-muted">Acciones</span>
            </div>

            <ul class="divide-y divide-line">
                @foreach ($model as $x)
                    <li class="grid gap-3 px-4 py-4 transition-colors hover:bg-canvas/60 lg:grid-cols-[minmax(0,1fr)_150px_230px] lg:items-center lg:gap-3 lg:px-5">

                        <div class="min-w-0">
                            <p class="truncate text-sm font-medium text-ink">{{ $x->titulo }}</p>
                            <p class="mt-0.5 line-clamp-1 text-xs text-muted">{{ Str::limit($x->descripcion, 80) }}</p>

                            <p class="mt-2 flex items-center gap-1.5 text-[11px] text-muted lg:hidden">
                                <span class="material-symbols-outlined text-[13px]" aria-hidden="true" focusable="false">schedule</span>
                                @if ($x->deleted_at)
                                    <time datetime="{{ $x->deleted_at->toIso8601String() }}">
                                        {{ $x->deleted_at->format('d/m/Y H:i') }}
                                    </time>
                                @else
                                    Sin fecha
                                @endif
                            </p>
                        </div>

                        <div class="hidden text-sm text-muted lg:block">
                            @if ($x->deleted_at)
                                <time datetime="{{ $x->deleted_at->toIso8601String() }}">
                                    {{ $x->deleted_at->format('d/m/Y H:i') }}
                                </time>
                            @else
                                —
                            @endif
                        </div>

                        <div class="flex flex-wrap items-center gap-1.5 lg:justify-end">
                            <form action="{{ route('tareas.restore', $x->id) }}" method="POST" class="inline-flex">
                                @csrf
                                @method('PATCH')

                                <button type="submit"
                                        aria-label="Restaurar la tarea «{{ $x->titulo }}»"
                                        class="inline-flex h-9 items-center gap-1.5 rounded-lg px-2.5 text-xs font-semibold text-success-700 transition hover:bg-success-50">
                                    <span class="material-symbols-outlined text-[17px]" aria-hidden="true" focusable="false">restore</span>
                                    Restaurar
                                </button>
                            </form>

                            <form action="{{ route('tareas.forceDelete', $x->id) }}" method="POST" class="inline-flex">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        data-confirm="¿Eliminar definitivamente la tarea «{{ $x->titulo }}»? Esta acción no se puede deshacer."
                                        aria-label="Eliminar definitivamente la tarea «{{ $x->titulo }}»"
                                        class="inline-flex h-9 items-center gap-1.5 rounded-lg px-2.5 text-xs font-semibold text-danger-600 transition hover:bg-danger-50">
                                    <span class="material-symbols-outlined text-[17px]" aria-hidden="true" focusable="false">delete_forever</span>
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>

            @if ($model->hasPages())
                <div class="border-t border-line px-5 py-4">
                    {{ $model->links() }}
                </div>
            @endif
        @endif
    </x-ui.card>

</div>

@endsection
