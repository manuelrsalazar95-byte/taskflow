@extends('layouts.app')

@section('content')

<div class="space-y-6">

    {{-- ENCABEZADO --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <div class="flex items-center gap-3">

                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                    <span class="material-symbols-outlined text-blue-600">
                        category
                    </span>
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

        <a href="{{ route('categorias.create') }}"
            class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-green-600 hover:bg-green-700 text-white font-medium shadow-sm transition">

            <span class="material-symbols-outlined text-[20px]">
                add
            </span>

            Crear Categoría

        </a>

    </div>

    {{-- TABLA --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="font-semibold text-gray-700">
                Lista de Categorías
            </h2>
        </div>

        <table class="w-full">

            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                        ID
                    </th>

                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Nombre
                    </th>

                    <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Acciones
                    </th>
                </tr>
            </thead>

            <tbody>

                @forelse ($model as $x)

                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-6 py-4 border-t">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">
                                #{{ $x->id }}
                            </span>
                        </td>

                        <td class="px-6 py-4 border-t font-medium text-gray-700">
                            {{ $x->name }}
                        </td>

                        <td class="px-6 py-4 border-t">

                            <div class="flex items-center justify-center gap-3">

                                <a href="{{ route('categorias.edit', $x->id) }}"
                                    class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-800">

                                    <span class="material-symbols-outlined text-[18px]">
                                        edit
                                    </span>

                                    Editar
                                </a>

                                <form action="{{ route('categorias.destroy', $x->id) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        onclick="return confirm('¿Está seguro de eliminar esta categoría?')"
                                        class="inline-flex items-center gap-1 text-red-600 hover:text-red-800">

                                        <span class="material-symbols-outlined text-[18px]">
                                            delete
                                        </span>

                                        Eliminar

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="3" class="py-16 text-center">

                            <div class="flex flex-col items-center gap-3">

                                <span class="material-symbols-outlined text-6xl text-gray-300">
                                    folder_off
                                </span>

                                <p class="text-gray-500 font-medium">
                                    No hay categorías registradas
                                </p>

                                <p class="text-sm text-gray-400">
                                    Crea tu primera categoría para comenzar.
                                </p>

                            </div>

                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>
    
</div>

@endsection