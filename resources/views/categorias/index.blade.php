@extends('layouts.app')

@section('title', 'Categorías · TaskFlow')

@section('content')

<div class="space-y-6">

    {{-- ENCABEZADO --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div class="flex items-center gap-3">

            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center" aria-hidden="true">
                <span class="material-symbols-outlined text-blue-700" aria-hidden="true" focusable="false">category</span>
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

        <a href="{{ route('categorias.create') }}"
           class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-green-700 hover:bg-green-800 text-white font-medium shadow-sm transition">

            <span class="material-symbols-outlined text-[20px]" aria-hidden="true" focusable="false">add</span>

            Crear Categoría

        </a>

    </div>

    {{-- TABLA --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200">

        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-700">
                Lista de Categorías
            </h2>
        </div>

        <div class="overflow-x-auto" role="region" aria-label="Tabla de categorías" tabindex="0">

            <table class="w-full">
                <caption class="sr-only">Listado de categorías con el número de tareas asociadas y sus acciones de edición y eliminación</caption>

                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            ID
                        </th>

                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Nombre
                        </th>

                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Tareas
                        </th>

                        <th scope="col" class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Acciones
                        </th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($model as $x)

                        <tr class="hover:bg-gray-50 transition">

                            <td class="px-6 py-4 border-t">
                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-100 text-blue-800 text-xs font-semibold">
                                    #{{ $x->id }}
                                </span>
                            </td>

                            <td class="px-6 py-4 border-t font-medium text-gray-700">
                                {{ $x->name }}
                            </td>

                            <td class="px-6 py-4 border-t text-sm text-gray-600">
                                {{ $x->tareas_count }}
                                {{ $x->tareas_count === 1 ? 'tarea' : 'tareas' }}
                            </td>

                            <td class="px-6 py-4 border-t">

                                <div class="flex items-center justify-center gap-2">

                                    <a href="{{ route('categorias.edit', $x->id) }}"
                                       aria-label="Editar la categoría «{{ $x->name }}»"
                                       class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold text-blue-700 bg-blue-50 hover:bg-blue-100 transition">

                                        <span class="material-symbols-outlined text-[16px]" aria-hidden="true" focusable="false">edit</span>

                                        Editar
                                    </a>

                                    <form action="{{ route('categorias.destroy', $x->id) }}"
                                          method="POST" class="inline-flex items-center m-0">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            data-confirm="¿Está seguro de eliminar la categoría «{{ $x->name }}»?"
                                            onclick="return confirm(this.dataset.confirm)"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold text-red-700 bg-red-50 hover:bg-red-100 transition">

                                            <span class="material-symbols-outlined text-[16px]" aria-hidden="true" focusable="false">delete</span>

                                            Eliminar

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" class="py-16 text-center">

                                <div class="flex flex-col items-center gap-3">

                                    <span class="material-symbols-outlined text-6xl text-gray-500" aria-hidden="true" focusable="false">folder_off</span>

                                    <p class="text-gray-600 font-medium">
                                        No hay categorías registradas
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        Crea tu primera categoría para comenzar.
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
