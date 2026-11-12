@extends('layouts.app')

@section('title', 'Crear tarea · TaskFlow')

@section('content')

@php
    $pageTitle = \Illuminate\Support\Str::ucfirst(\Illuminate\Support\Str::lower($titulo));
    $pageDescription = \Illuminate\Support\Str::ucfirst(\Illuminate\Support\Str::lower($descripcion));
@endphp

<div class="space-y-6">

    <x-ui.page-header
        eyebrow="Tareas"
        :title="$pageTitle"
        :subtitle="$pageDescription"
        icon="add_task"
    >
        <x-ui.button :href="route('tareas.index')" variant="secondary" size="md">
            <span class="material-symbols-outlined text-[18px]" aria-hidden="true" focusable="false">arrow_back</span>
            Volver a tareas
        </x-ui.button>
    </x-ui.page-header>

    <div class="grid gap-6 xl:grid-cols-3">

        <x-ui.card class="xl:col-span-2">
            <form action="{{ route('tareas.store') }}" method="POST" class="space-y-5" data-pending-form>
                @csrf

                @if ($errors->any())
                    <div class="mb-5">
                        <x-ui.error-summary />
                    </div>
                @endif

                <x-ui.input
                    name="titulo"
                    label="Título"
                    :value="old('titulo')"
                    placeholder="Ej. Preparar el informe mensual"
                    :required="true"
                    autofocus
                />

                <x-ui.textarea
                    name="descripcion"
                    label="Descripción"
                    placeholder="Describe qué hay que hacer y cualquier detalle útil."
                    :required="true"
                    :rows="5"
                />

                <div class="grid gap-5 sm:grid-cols-2">
                    <x-ui.select name="categoria_id" label="Categoría" :required="true" hint="Organiza la tarea dentro de tu espacio.">
                        <option value="" @selected(! old('categoria_id')) disabled>— Selecciona una categoría —</option>
                        @forelse ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" @selected(old('categoria_id') == $categoria->id)>
                                {{ $categoria->name }}
                            </option>
                        @empty
                            <option value="" disabled>No hay categorías registradas. Crea una primero.</option>
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
                            Las tareas son privadas: solo tú puedes verlas y gestionarlas.
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-2.5 rounded-xl bg-canvas px-3.5 py-3 text-xs leading-relaxed text-muted">
                    <span class="material-symbols-outlined mt-0.5 text-[17px]" aria-hidden="true" focusable="false">info</span>
                    <p>
                        <span class="text-danger-600" aria-hidden="true">*</span> Campo obligatorio.
                        La tarea se creará con el estado <strong class="font-semibold text-ink">Pendiente</strong> y podrás cambiarlo desde el listado.
                    </p>
                </div>

                <div class="flex flex-col-reverse gap-2 border-t border-line pt-5 sm:flex-row sm:justify-end">
                    <x-ui.button :href="route('tareas.index')" variant="ghost" size="lg">
                        Cancelar
                    </x-ui.button>

                    <x-ui.button type="submit" variant="primary" size="lg">
                        <span class="material-symbols-outlined text-[18px]" aria-hidden="true" focusable="false">add_circle</span>
                        Guardar tarea
                    </x-ui.button>
                </div>
            </form>
        </x-ui.card>

        <aside class="space-y-6">
            <x-ui.card>
                <h2 class="text-sm font-semibold text-ink">Antes de guardar</h2>

                <ul class="mt-4 space-y-3 text-sm text-muted">
                    <li class="flex items-start gap-2.5">
                        <span class="material-symbols-outlined mt-0.5 text-[18px] text-brand-600" aria-hidden="true" focusable="false">title</span>
                        Un título corto y concreto se lee mejor en el listado.
                    </li>
                    <li class="flex items-start gap-2.5">
                        <span class="material-symbols-outlined mt-0.5 text-[18px] text-brand-600" aria-hidden="true" focusable="false">notes</span>
                        La descripción guarda el contexto que no cabe en el título.
                    </li>
                    <li class="flex items-start gap-2.5">
                        <span class="material-symbols-outlined mt-0.5 text-[18px] text-brand-600" aria-hidden="true" focusable="false">folder</span>
                        Una categoría clara facilita encontrarla después.
                    </li>
                </ul>
            </x-ui.card>

            <x-ui.card class="bg-brand-50/60">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-[20px] text-brand-700" aria-hidden="true" focusable="false">lock</span>
                    <div>
                        <p class="text-sm font-semibold text-ink">Tu espacio privado</p>
                        <p class="mt-1 text-xs leading-relaxed text-muted">
                            Nadie más puede ver ni editar esta tarea. Puedes archivarla en la papelera cuando termines.
                        </p>
                    </div>
                </div>
            </x-ui.card>
        </aside>

    </div>

</div>

@endsection
