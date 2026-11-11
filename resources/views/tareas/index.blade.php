@extends('layouts.app')

@section('title', 'Tareas · TaskFlow')

@section('content')

<div class="space-y-6">

    <x-ui.page-header
        eyebrow="Espacio de trabajo"
        :title="ucfirst($titulo)"
        :subtitle="$descripcion.' · Solo tú ves estas tareas.'"
        icon="task_alt"
    >
        <x-ui.button :href="route('tareas.trash')" variant="secondary" size="md">
            <span class="material-symbols-outlined text-[18px]" aria-hidden="true" focusable="false">delete_sweep</span>
            Papelera
        </x-ui.button>

        <x-ui.button :href="route('tareas.create')" variant="primary" size="md">
            <span class="material-symbols-outlined text-[18px]" aria-hidden="true" focusable="false">add</span>
            Crear tarea
        </x-ui.button>
    </x-ui.page-header>

    {{-- Búsqueda y filtros --}}
    <x-ui.card>
        <form action="{{ route('tareas.index') }}" method="GET" id="filterForm" aria-label="Búsqueda y filtros de tareas">
            <div class="grid gap-3 sm:grid-cols-2 xl:grid-cols-[minmax(0,1fr)_170px_190px_auto] xl:items-end">

                <div class="sm:col-span-2 xl:col-span-1">
                    <label for="buscar" class="mb-1.5 block text-xs font-medium text-muted">Buscar</label>
                    <div class="relative">
                        <span class="material-symbols-outlined pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-[20px] text-muted"
                              aria-hidden="true" focusable="false">search</span>
                        <input
                            type="search"
                            id="buscar"
                            name="buscar"
                            value="{{ $filtros['buscar'] ?? '' }}"
                            placeholder="Título o descripción…"
                            class="w-full rounded-xl border border-field bg-surface py-2.5 pl-10 pr-4 text-sm text-ink placeholder:text-muted transition focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-100">
                    </div>
                </div>

                <x-ui.select name="estado" label="Estado" id="estado" data-auto-submit>
                    <option value="" @selected(($filtros['estado'] ?? '') === '')>Todos los estados</option>
                    <option value="pendiente" @selected(($filtros['estado'] ?? '') === 'pendiente')>Pendiente</option>
                    <option value="en_progreso" @selected(($filtros['estado'] ?? '') === 'en_progreso')>En progreso</option>
                    <option value="completada" @selected(($filtros['estado'] ?? '') === 'completada')>Completada</option>
                </x-ui.select>

                <x-ui.select name="categoria_id" label="Categoría" id="categoria_id" data-auto-submit>
                    <option value="" @selected(($filtros['categoria_id'] ?? '') === '')>Todas las categorías</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}"
                            @selected((string) ($filtros['categoria_id'] ?? '') === (string) $categoria->id)>
                            {{ $categoria->name }}
                        </option>
                    @endforeach
                </x-ui.select>

                <div class="flex items-center gap-2">
                    <x-ui.button type="submit" variant="secondary" size="md" class="w-full lg:w-auto">
                        Aplicar
                    </x-ui.button>

                    @if (count($filtros))
                        <x-ui.button :href="route('tareas.index')" variant="ghost" size="md">
                            Limpiar
                        </x-ui.button>
                    @endif
                </div>
            </div>
        </form>
    </x-ui.card>

    {{-- Listado --}}
    <x-ui.card :padding="false" class="overflow-hidden">
        <div class="flex items-center justify-between gap-4 border-b border-line px-5 py-4">
            <div>
                <h2 class="text-sm font-semibold text-ink">Listado de tareas</h2>
                <p class="mt-0.5 text-xs text-muted">
                    {{ $model->total() }} {{ $model->total() === 1 ? 'tarea' : 'tareas' }}
                    @if (count($filtros)) con los filtros actuales @endif
                </p>
            </div>
        </div>

        @if ($model->isEmpty())
            <x-ui.empty-state
                icon="task_off"
                :title="count($filtros) ? 'Sin resultados' : 'Aún no hay tareas'"
                :description="count($filtros)
                    ? 'No hay tareas que coincidan con la búsqueda o los filtros aplicados.'
                    : 'Crea tu primera tarea y empieza a ordenar tu día.'"
            >
                @if (count($filtros))
                    <x-ui.button :href="route('tareas.index')" variant="secondary" size="md">
                        Limpiar filtros
                    </x-ui.button>
                @else
                    <x-ui.button :href="route('tareas.create')" variant="primary" size="md">
                        Crear tarea
                    </x-ui.button>
                @endif
            </x-ui.empty-state>
        @else
            {{-- Cabecera de columnas (solo escritorio) --}}
            <div class="hidden grid-cols-[minmax(0,1fr)_150px_140px_130px] gap-3 border-b border-line bg-canvas/60 px-5 py-2.5 lg:grid"
                 aria-hidden="true">
                <span class="text-xs font-medium text-muted">Tarea</span>
                <span class="text-xs font-medium text-muted">Categoría</span>
                <span class="text-xs font-medium text-muted">Estado</span>
                <span class="text-right text-xs font-medium text-muted">Acciones</span>
            </div>

            <ul class="divide-y divide-line">
                @foreach ($model as $x)
                    <li class="grid gap-3 px-4 py-4 transition-colors hover:bg-canvas/60 lg:grid-cols-[minmax(0,1fr)_150px_140px_130px] lg:items-center lg:gap-3 lg:px-5">

                        {{-- Tarea --}}
                        <div class="min-w-0">
                            <p class="truncate text-sm font-medium text-ink">{{ $x->titulo }}</p>
                            <p class="mt-0.5 line-clamp-1 text-xs text-muted">{{ Str::limit($x->descripcion, 80) }}</p>

                            {{-- Categoría en móvil --}}
                            <span class="mt-2 inline-flex items-center gap-1.5 rounded-full bg-canvas px-2 py-0.5 text-[11px] font-medium text-muted ring-1 ring-line lg:hidden">
                                <span class="material-symbols-outlined text-[13px]" aria-hidden="true" focusable="false">folder</span>
                                {{ $x->categoria->name ?? 'Sin categoría' }}
                            </span>
                        </div>

                        {{-- Categoría (escritorio) --}}
                        <div class="hidden min-w-0 lg:block">
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-canvas px-2.5 py-1 text-xs font-medium text-muted ring-1 ring-line">
                                <span class="material-symbols-outlined text-[14px]" aria-hidden="true" focusable="false">folder</span>
                                <span class="truncate">{{ $x->categoria->name ?? 'Sin categoría' }}</span>
                            </span>
                        </div>

                        {{-- Estado --}}
                        <div>
                            <x-ui.status-select :tarea="$x" />
                        </div>

                        {{-- Acciones --}}
                        <div class="flex items-center gap-1.5 lg:justify-end">
                            <a href="{{ route('tareas.edit', $x->id) }}"
                               aria-label="Editar la tarea «{{ $x->titulo }}»"
                               class="inline-flex h-9 items-center gap-1.5 rounded-lg px-2.5 text-xs font-semibold text-brand-700 transition hover:bg-brand-50">
                                <span class="material-symbols-outlined text-[17px]" aria-hidden="true" focusable="false">edit</span>
                                Editar
                            </a>

                            <form action="{{ route('tareas.destroy', $x->id) }}"
                                  method="POST"
                                  class="inline-flex items-center">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        data-confirm="¿Enviar a la papelera la tarea «{{ $x->titulo }}»?"
                                        class="inline-flex h-9 items-center gap-1.5 rounded-lg px-2.5 text-xs font-semibold text-danger-600 transition hover:bg-danger-50">
                                    <span class="material-symbols-outlined text-[17px]" aria-hidden="true" focusable="false">delete</span>
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>

            {{-- Paginación --}}
            @if ($model->hasPages())
                <div class="border-t border-line px-5 py-4">
                    {{ $model->links() }}
                </div>
            @endif
        @endif
    </x-ui.card>

</div>

@endsection
