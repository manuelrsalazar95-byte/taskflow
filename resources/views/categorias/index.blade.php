@extends('layouts.app')

@section('title', 'Categorías · TaskFlow')

@section('content')

@php
    $pageTitle = \Illuminate\Support\Str::ucfirst(\Illuminate\Support\Str::lower($titulo));
    $pageDescription = \Illuminate\Support\Str::ucfirst(\Illuminate\Support\Str::lower($descripcion));
@endphp

<div class="space-y-6">

    <x-ui.page-header
        eyebrow="Espacio de trabajo"
        :title="$pageTitle"
        :subtitle="$pageDescription.' · Agrupa tus tareas para encontrarlas antes.'"
        icon="folder"
    >
        <x-ui.button :href="route('categorias.create')" variant="primary" size="md">
            <span class="material-symbols-outlined text-[18px]" aria-hidden="true" focusable="false">add</span>
            Crear categoría
        </x-ui.button>
    </x-ui.page-header>

    <x-ui.card :padding="false" class="overflow-hidden">
        <div class="flex items-center justify-between gap-4 border-b border-line px-5 py-4">
            <div>
                <h2 class="text-sm font-semibold text-ink">Listado de categorías</h2>
                <p class="mt-0.5 text-xs text-muted">
                    {{ $model->total() }} {{ $model->total() === 1 ? 'categoría' : 'categorías' }} en tu espacio.
                </p>
            </div>
        </div>

        @if ($model->isEmpty())
            <x-ui.empty-state
                icon="folder_off"
                title="Aún no hay categorías"
                description="Crea tu primera categoría para agrupar tus tareas por tema o proyecto."
            >
                <x-ui.button :href="route('categorias.create')" variant="primary" size="md">
                    Crear categoría
                </x-ui.button>
            </x-ui.empty-state>
        @else
            {{-- Cabecera de columnas (solo escritorio) --}}
            <div class="hidden grid-cols-[minmax(0,1fr)_140px_190px] gap-3 border-b border-line bg-canvas/60 px-5 py-2.5 lg:grid"
                 aria-hidden="true">
                <span class="text-xs font-medium text-muted">Categoría</span>
                <span class="text-xs font-medium text-muted">Tareas</span>
                <span class="text-right text-xs font-medium text-muted">Acciones</span>
            </div>

            <ul class="divide-y divide-line">
                @foreach ($model as $x)
                    <li class="grid gap-3 px-4 py-4 transition-colors hover:bg-canvas/60 lg:grid-cols-[minmax(0,1fr)_140px_190px] lg:items-center lg:gap-3 lg:px-5">

                        <div class="flex min-w-0 items-center gap-3">
                            <span class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-xl bg-brand-50 text-brand-700"
                                  aria-hidden="true">
                                <span class="material-symbols-outlined text-[18px]" aria-hidden="true" focusable="false">folder</span>
                            </span>

                            <p class="truncate text-sm font-medium text-ink">{{ $x->name }}</p>
                        </div>

                        <div>
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-canvas px-2.5 py-1 text-xs font-medium text-muted ring-1 ring-line">
                                <span class="material-symbols-outlined text-[14px]" aria-hidden="true" focusable="false">task_alt</span>
                                {{ $x->tareas_count }} {{ $x->tareas_count === 1 ? 'tarea' : 'tareas' }}
                            </span>
                        </div>

                        <div class="flex flex-wrap items-center gap-1.5 lg:justify-end">
                            <a href="{{ route('categorias.edit', $x->id) }}"
                               aria-label="Editar la categoría «{{ $x->name }}»"
                               class="inline-flex h-9 items-center gap-1.5 rounded-lg px-2.5 text-xs font-semibold text-brand-700 transition hover:bg-brand-50">
                                <span class="material-symbols-outlined text-[17px]" aria-hidden="true" focusable="false">edit</span>
                                Editar
                            </a>

                            <form action="{{ route('categorias.destroy', $x->id) }}"
                                  method="POST"
                                  class="inline-flex items-center">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        data-confirm="¿Eliminar la categoría «{{ $x->name }}»?"
                                        class="inline-flex h-9 items-center gap-1.5 rounded-lg px-2.5 text-xs font-semibold text-danger-600 transition hover:bg-danger-50">
                                    <span class="material-symbols-outlined text-[17px]" aria-hidden="true" focusable="false">delete</span>
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
