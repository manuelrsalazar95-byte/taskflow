@extends('layouts.app')

@section('title', 'Papelera de tareas · TaskFlow')

@section('content')

<div class="space-y-6">

    {{-- ENCABEZADO --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <div class="flex items-center gap-3">

                <div class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center" aria-hidden="true">
                    <span class="material-symbols-outlined text-gray-700" aria-hidden="true" focusable="false">delete_sweep</span>
                </div>

                <div>
                    <h1 class="text-2xl font-bold text-gray-800">
                        {{ ucfirst($titulo) }}
                    </h1>

                    <p class="text-gray-500">
                        {{ $descripcion }}
                    </p>
                </div>

            </div>
        </div>

        {{-- VOLVER --}}
        <a href="{{ route('tareas.index') }}"
            class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-medium shadow-sm transition">

            <span class="material-symbols-outlined text-[20px]" aria-hidden="true" focusable="false">arrow_back</span>

            Volver a Tareas

        </a>

    </div>


    {{-- TABLA --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200">

        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-700">
                Tareas en Papelera
            </h2>
        </div>

        <div class="overflow-x-auto pb-4" role="region" aria-label="Tabla de tareas en la papelera" tabindex="0">

            <table class="w-full">
                <caption class="sr-only">
                    Tareas eliminadas con su fecha de borrado y las acciones de restauración o eliminación definitiva
                </caption>

                <thead class="bg-gray-50">

                    <tr>

                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            ID
                        </th>

                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Título
                        </th>

                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Descripción
                        </th>
                        
                        <th scope="col" class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Eliminado el
                        </th>

                        <th scope="col" class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Acciones
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($model as $x)

                        <tr class="hover:bg-gray-50 transition">

                            {{-- ID --}}
                            <td class="px-6 py-4 border-t">

                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-semibold">
                                    #{{ $x->id }}
                                </span>

                            </td>


                            {{-- TÍTULO --}}
                            <td class="px-6 py-4 border-t font-medium text-gray-700">
                                {{ $x->titulo }}
                            </td>


                            {{-- DESCRIPCIÓN --}}
                            <td class="px-6 py-4 border-t text-gray-600">
                                {{ Str::limit($x->descripcion, 50) }}
                            </td>

                            {{-- ELIMINADO EL --}}
                            <td class="px-6 py-4 border-t text-center text-sm text-gray-600">
                                @if($x->deleted_at)
                                    <time datetime="{{ $x->deleted_at->toIso8601String() }}">
                                        {{ $x->deleted_at->format('d/m/Y H:i') }}
                                    </time>
                                @endif
                            </td>


                            {{-- ACCIONES --}}
                            <td class="px-6 py-4 border-t">

                                <div class="flex items-center justify-center gap-3">

                                    {{-- RESTAURAR --}}
                                    <form action="{{ route('tareas.restore', $x->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button
                                            type="submit"
                                            aria-label="Restaurar la tarea «{{ $x->titulo }}»"
                                            class="inline-flex items-center gap-1 text-emerald-700 hover:text-emerald-900 font-medium">

                                            <span class="material-symbols-outlined text-[18px]" aria-hidden="true" focusable="false">restore</span>

                                            Restaurar

                                        </button>
                                    </form>


                                    {{-- ELIMINAR DEFINITIVAMENTE --}}
                                    <form action="{{ route('tareas.forceDelete', $x->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            data-confirm="¿Eliminar definitivamente la tarea «{{ $x->titulo }}»? Esta acción no se puede deshacer."
                                            onclick="return confirm(this.dataset.confirm)"
                                            class="inline-flex items-center gap-1 text-red-700 hover:text-red-900 font-medium">

                                            <span class="material-symbols-outlined text-[18px]" aria-hidden="true" focusable="false">delete_forever</span>

                                            Eliminar definitivo

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="py-16 text-center">

                                <div class="flex flex-col items-center gap-3">

                                    <span class="material-symbols-outlined text-6xl text-gray-500" aria-hidden="true" focusable="false">delete_sweep</span>

                                    <p class="text-gray-600 font-medium">
                                        La papelera está vacía
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        No hay tareas eliminadas en este momento.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- PAGINACIÓN --}}
        @if($model->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $model->links() }}
            </div>
        @endif

    </div>

</div>

@endsection
