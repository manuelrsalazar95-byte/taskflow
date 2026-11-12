@extends('layouts.app')

@section('title', 'Editar categoría · TaskFlow')

@section('content')

@php
    $pageTitle = \Illuminate\Support\Str::ucfirst(\Illuminate\Support\Str::lower($titulo));
@endphp

<div class="space-y-6">

    <x-ui.page-header
        eyebrow="Categorías"
        :title="$pageTitle"
        :subtitle="'Modifica el nombre de «'.$model->name.'».'"
        icon="edit"
    >
        <x-ui.button :href="route('categorias.index')" variant="secondary" size="md">
            <span class="material-symbols-outlined text-[18px]" aria-hidden="true" focusable="false">arrow_back</span>
            Volver a categorías
        </x-ui.button>
    </x-ui.page-header>

    <div class="grid gap-6 xl:grid-cols-3">

        <x-ui.card class="xl:col-span-2">
            <form method="POST" action="{{ route('categorias.update', $model->id) }}" class="space-y-5" data-pending-form>
                @csrf
                @method('PUT')

                @if ($errors->any())
                    <div class="mb-5">
                        <x-ui.error-summary />
                    </div>
                @endif

                <x-ui.input
                    name="name"
                    label="Nombre de la categoría"
                    :value="$model->name"
                    :required="true"
                    hint="El nuevo nombre se aplicará a todas las tareas de esta categoría."
                    autofocus
                />

                <div class="flex flex-col-reverse gap-2 border-t border-line pt-5 sm:flex-row sm:justify-end">
                    <x-ui.button :href="route('categorias.index')" variant="ghost" size="lg">
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
                        <dt class="text-muted">Tareas asociadas</dt>
                        <dd class="font-medium text-ink tabular-nums">{{ $model->tareas()->withTrashed()->count() }}</dd>
                    </div>

                    <div class="flex items-center justify-between gap-4">
                        <dt class="text-muted">Creada</dt>
                        <dd class="text-right text-ink">
                            <time datetime="{{ $model->created_at?->toIso8601String() }}">
                                {{ $model->created_at?->format('d/m/Y') }}
                            </time>
                        </dd>
                    </div>
                </dl>
            </x-ui.card>

            <x-ui.card>
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-[20px] text-muted" aria-hidden="true" focusable="false">tips_and_updates</span>
                    <div>
                        <p class="text-sm font-semibold text-ink">Antes de renombrar</p>
                        <p class="mt-1 text-xs leading-relaxed text-muted">
                            Si la categoría todavía tiene tareas asociadas, no podrás eliminarla. Primero muévelas o archívalas.
                        </p>
                    </div>
                </div>
            </x-ui.card>
        </aside>

    </div>

</div>

@endsection
