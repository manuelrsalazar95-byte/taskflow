@extends('layouts.app')

@section('content')

<div class="space-y-6">

    {{-- ENCABEZADO --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <div class="flex items-center gap-3">

                <div class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center">
                    <span class="material-symbols-outlined text-gray-600">
                        delete_sweep
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

        {{-- VOLVER --}}
        <a href="{{ route('tareas.index') }}"
            class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-medium shadow-sm transition">

            <span class="material-symbols-outlined text-[20px]">
                arrow_back
            </span>

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

        <div class="overflow-x-auto pb-4">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            ID
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Título
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Descripción
                        </th>
                        
                        <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-gray-500">
                            Eliminado el
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold uppercase tracking-wider text-gray-500">
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
                            <td class="px-6 py-4 border-t text-center text-sm text-gray-500">
                                {{ $x->deleted_at?->format('d/m/Y H:i') }}
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
                                            class="inline-flex items-center gap-1 text-emerald-600 hover:text-emerald-800 font-medium">

                                            <span class="material-symbols-outlined text-[18px]">
                                                restore
                                            </span>

                                            Restaurar

                                        </button>
                                    </form>


                                    {{-- ELIMINAR DEFINITIVAMENTE --}}
                                    <form action="{{ route('tareas.forceDelete', $x->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            onclick="return confirm('¿Está seguro de eliminar esta tarea permanentemente? Esta acción no se puede deshacer.')"
                                            class="inline-flex items-center gap-1 text-red-600 hover:text-red-800 font-medium">

                                            <span class="material-symbols-outlined text-[18px]">
                                                delete_forever
                                            </span>

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

                                    <span class="material-symbols-outlined text-6xl text-gray-300">
                                        delete_sweep
                                    </span>

                                    <p class="text-gray-500 font-medium">
                                        La papelera está vacía
                                    </p>

                                    <p class="text-sm text-gray-400">
                                        No hay tareas eliminadas en este momento.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
