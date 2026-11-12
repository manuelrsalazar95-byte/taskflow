@extends('layouts.app')

@section('title', 'Crear categoría · TaskFlow')

@section('content')

@php
    $pageTitle = \Illuminate\Support\Str::ucfirst(\Illuminate\Support\Str::lower($titulo));
    $pageDescription = \Illuminate\Support\Str::ucfirst(\Illuminate\Support\Str::lower($descripcion));
@endphp

<div class="space-y-6">

    <x-ui.page-header
        eyebrow="Categorías"
        :title="$pageTitle"
        :subtitle="$pageDescription"
        icon="create_new_folder"
    >
        <x-ui.button :href="route('categorias.index')" variant="secondary" size="md">
            <span class="material-symbols-outlined text-[18px]" aria-hidden="true" focusable="false">arrow_back</span>
            Volver a categorías
        </x-ui.button>
    </x-ui.page-header>

    <div class="grid gap-6 xl:grid-cols-3">

        <x-ui.card class="xl:col-span-2">
            <form method="POST" action="{{ route('categorias.store') }}" class="space-y-5" data-pending-form>
                @csrf

                @if ($errors->any())
                    <div class="mb-5">
                        <x-ui.error-summary />
                    </div>
                @endif

                <x-ui.input
                    name="name"
                    label="Nombre de la categoría"
                    :value="old('name')"
                    placeholder="Ej. Desarrollo web"
                    :required="true"
                    hint="Un nombre corto y reconocible. Podrás cambiarlo cuando quieras."
                    autofocus
                />

                <div class="flex flex-col-reverse gap-2 border-t border-line pt-5 sm:flex-row sm:justify-end">
                    <x-ui.button :href="route('categorias.index')" variant="ghost" size="lg">
                        Cancelar
                    </x-ui.button>

                    <x-ui.button type="submit" variant="primary" size="lg">
                        <span class="material-symbols-outlined text-[18px]" aria-hidden="true" focusable="false">add_circle</span>
                        Crear categoría
                    </x-ui.button>
                </div>
            </form>
        </x-ui.card>

        <aside class="space-y-6">
            <x-ui.card>
                <h2 class="text-sm font-semibold text-ink">Para qué sirve</h2>

                <ul class="mt-4 space-y-3 text-sm text-muted">
                    <li class="flex items-start gap-2.5">
                        <span class="material-symbols-outlined mt-0.5 text-[18px] text-brand-600" aria-hidden="true" focusable="false">filter_list</span>
                        Filtrar tareas por tema en un clic.
                    </li>
                    <li class="flex items-start gap-2.5">
                        <span class="material-symbols-outlined mt-0.5 text-[18px] text-brand-600" aria-hidden="true" focusable="false">visibility</span>
                        Ver de un vistazo cuántas tareas contiene.
                    </li>
                    <li class="flex items-start gap-2.5">
                        <span class="material-symbols-outlined mt-0.5 text-[18px] text-brand-600" aria-hidden="true" focusable="false">lock</span>
                        Mantener tus áreas de trabajo separadas y privadas.
                    </li>
                </ul>
            </x-ui.card>
        </aside>

    </div>

</div>

@endsection
