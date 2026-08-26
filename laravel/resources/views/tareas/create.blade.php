@extends('layouts.app')

@section('content')

<div class="space-y-6">

    {{-- ENCABEZADO --}}
    <div class="flex items-center gap-3">

        <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">

            <span class="material-symbols-outlined text-blue-600">
                task_alt
            </span>

        </div>

        <div>

            <h1 class="text-2xl font-bold text-gray-800">
                Crear Tarea
            </h1>

            <p class="text-gray-500">
                Registra una nueva tarea.
            </p>

        </div>

    </div>


    {{-- FORMULARIO --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

        <form action="{{ route('tareas.store') }}" method="POST">

            @csrf

            <div class="space-y-6">


                {{-- TÍTULO --}}
                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Título
                    </label>

                    <input
                        type="text"
                        name="titulo"
                        value="{{ old('titulo') }}"
                        placeholder="Ejemplo: Revisar reporte mensual"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>

                    @error('titulo')
                        <p class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- DESCRIPCIÓN --}}
                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Descripción
                    </label>

                    <textarea
                        name="descripcion"
                        rows="4"
                        placeholder="Describe la tarea..."
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>{{ old('descripcion') }}</textarea>

                    @error('descripcion')
                        <p class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- ESTADO --}}
                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Estado
                    </label>

                    <select
                        name="estado"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>

                        <option value="pendiente">
                            Pendiente
                        </option>

                        <option value="en_progreso">
                            En progreso
                        </option>

                        <option value="completada">
                            Completada
                        </option>

                    </select>

                    @error('estado')
                        <p class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- BOTONES --}}
                <div class="flex justify-end gap-3 pt-4">

                    <a
                        href="{{ route('tareas.index') }}"
                        class="px-5 py-3 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-50">

                        Cancelar

                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-green-600 hover:bg-green-700 text-white font-medium">

                        <span class="material-symbols-outlined text-[20px]">
                            save
                        </span>

                        Guardar Tarea

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection