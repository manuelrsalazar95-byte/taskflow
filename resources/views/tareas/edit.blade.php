@extends('layouts.app')

@section('title', 'Editar tarea · TaskFlow')

@section('content')

<div class="space-y-6">

    <x-ui.page-header
        eyebrow="Tareas"
        :title="$titulo"
        :subtitle="'Actualiza la información de «'.$tarea->titulo.'».'"
        icon="edit"
    >
        <x-ui.button :href="route('tareas.index')" variant="secondary" size="md">
            <span class="material-symbols-outlined text-[18px]" aria-hidden="true" focusable="false">arrow_back</span>
            Volver a tareas
        </x-ui.button>
    </x-ui.page-header>

    <div class="grid gap-6 lg:grid-cols-3">

        <x-ui.card class="lg:col-span-2">
            <form action="{{ route('tareas.update', $tarea->id) }}" method="POST" class="space-y-5" data-pending-form>
                @csrf
                @method('PUT')

                @if ($errors->any())
                    <div class="mb-5">
                        <x-ui.error-summary />
                    </div>
                @endif

                <x-ui.input
                    name="titulo"
                    label="Título"
                    :value="$tarea->titulo"
                    :required="true"
                    autofocus
                />

                <x-ui.textarea
                    name="descripcion"
                    label="Descripción"
                    :value="$tarea->descripcion"
                    :required="true"
                    :rows="5"
                />

                <div class="grid gap-5 sm:grid-cols-2">
                    <x-ui.select name="categoria_id" label="Categoría" :required="true" hint="Puedes mover la tarea a otra categoría.">
                        @forelse ($categorias as $categoria)
                            <option value="{{ $categoria->id }}"
                                @selected(old('categoria_id', $tarea->categoria_id) == $categoria->id)>
                                {{ $categoria->name }}
                            </option>
                        @empty
                            <option value="" disabled>No hay categorías registradas.</option>
                        @endforelse
                    </x-ui.select>

                    <div>
                        <p class="mb-1.5 block text-sm font-medium text-ink">Responsable</p>

                        <div class="flex items-center gap-2.5 rounded-xl border border-line bg-canvas px-3.5 py-2.5 text-sm text-muted">
                            <span class="flex h-6 w-6 items-center justify-center rounded-full bg-brand-50 text-[10px] font-semibold text-brand-700"
                                  aria-hidden="true">
                                {{ strtoupper(substr(auth()->user()->user_name ?? 'U', 0, 2)) }}
                            </span>
                            {{ auth()->user()->user_name }}
                        </div>

                        <p class="mt-1.5 text-xs text-muted">
                            El propietario no cambia al editar la tarea.
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-2.5 rounded-xl bg-canvas px-3.5 py-3 text-xs leading-relaxed text-muted">
                    <span class="material-symbols-outlined mt-0.5 text-[17px]" aria-hidden="true" focusable="false">info</span>
                    <p>
                        <span class="text-danger-600" aria-hidden="true">*</span> Campo obligatorio.
                        Para cambiar el estado, usa el selector del listado de tareas.
                    </p>
                </div>

                <div class="flex flex-col-reverse gap-2 border-t border-line pt-5 sm:flex-row sm:justify-end">
                    <x-ui.button :href="route('tareas.index')" variant="ghost" size="lg">
                        Cancelar
                    </x-ui.button>

                    <x-ui.button type="submit" variant="primary" size="lg">
                        <span class="material-symbols-outlined text-[18px]" aria-hidden="true" focusable="false">save</span>
                        Guardar cambios
                    </x-ui.button>
                </div>
            </form>
        </x-ui.card>

        <aside class="space-y-6">
            <x-ui.card>
                <h2 class="text-sm font-semibold text-ink">Detalles</h2>

                <dl class="mt-4 space-y-3 text-sm">
                    <div class="flex items-center justify-between gap-4">
                        <dt class="text-muted">Estado actual</dt>
                        <dd><x-ui.badge :estado="$tarea->estado" /></dd>
                    </div>

                    <div class="flex items-center justify-between gap-4">
                        <dt class="text-muted">Categoría actual</dt>
                        <dd class="truncate text-right font-medium text-ink">{{ $tarea->categoria->name ?? 'Sin categoría' }}</dd>
                    </div>

                    <div class="flex items-center justify-between gap-4">
                        <dt class="text-muted">Creada</dt>
                        <dd class="text-right text-ink">
                            <time datetime="{{ $tarea->created_at?->toIso8601String() }}">
                                {{ $tarea->created_at?->format('d/m/Y') }}
                            </time>
                        </dd>
                    </div>
                </dl>
            </x-ui.card>

            <x-ui.card>
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-[20px] text-muted" aria-hidden="true" focusable="false">tips_and_updates</span>
                    <div>
                        <p class="text-sm font-semibold text-ink">Un cambio pequeño cada vez</p>
                        <p class="mt-1 text-xs leading-relaxed text-muted">
                            Mantén el título y la descripción al día: son lo que verás cuando vuelvas a la lista.
                        </p>
                    </div>
                </div>
            </x-ui.card>
        </aside>

    </div>

</div>

@endsection
