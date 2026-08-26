@extends('layouts.app')

@section('content')

<div class="space-y-6">

    {{-- Encabezado --}}
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-6 rounded-2xl shadow-md">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-4xl">
                        category
                    </span>

                    <div>
                        <h1 class="text-2xl font-bold">
                            {{ $titulo }}
                        </h1>

                        <p class="text-blue-100 mt-1">
                            {{ $descripcion }}
                        </p>
                    </div>
                </div>
            </div>

            <a href="{{ route('categorias.index') }}"
                class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-white/20 hover:bg-white/30 rounded-lg transition backdrop-blur-sm">

                <span class="material-symbols-outlined text-sm">
                    arrow_back
                </span>

                Volver a Categorías
            </a>

        </div>

    </div>

    {{-- Tarjeta del formulario --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

        {{-- Cabecera --}}
        <div class="border-b border-gray-200 px-6 py-4 bg-gray-50">
            <h2 class="text-lg font-semibold text-gray-800">
                Editar Categoría
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Modifica la información de la categoría seleccionada.
            </p>
        </div>

        {{-- Formulario --}}
        <form method="POST"
            action="{{ route('categorias.update', $model->id) }}"
            class="p-6 space-y-6">

            @csrf
            @method('PUT')

            {{-- Nombre --}}
            <div>
                <label for="name"
                    class="block mb-2 text-sm font-medium text-gray-700">
                    Nombre de la categoría
                </label>

                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name', $model->name) }}"
                    required
                    autofocus
                    placeholder="Ingrese el nombre de la categoría"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3
                           text-gray-700
                           focus:outline-none
                           focus:ring-2
                           focus:ring-blue-500
                           focus:border-blue-500
                           transition">

                @error('name')
                    <p class="mt-2 text-sm text-red-500">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Botones --}}
            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-gray-200">

                <a href="{{ route('categorias.index') }}"
                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl transition">

                    <span class="material-symbols-outlined text-sm">
                        close
                    </span>

                    Cancelar
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-green-600 hover:bg-green-700 text-white font-medium rounded-xl shadow-sm transition">

                    <span class="material-symbols-outlined text-sm">
                        save
                    </span>

                    Actualizar Categoría
                </button>

            </div>

        </form>

    </div>

</div>

@endsection