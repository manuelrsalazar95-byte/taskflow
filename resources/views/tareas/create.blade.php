@extends('layouts.app')

@section('title', 'Crear tarea · TaskFlow')

@section('content')

<div class="space-y-6">

    {{-- Encabezado --}}
    <div class="bg-gradient-to-r from-blue-700 to-indigo-700 text-white p-6 rounded-2xl shadow-md">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-4xl" aria-hidden="true" focusable="false">task_alt</span>

                <div>
                    <h1 class="text-2xl font-bold">
                        {{ $titulo }}
                    </h1>

                    <p class="text-blue-50 mt-1">
                        {{ $descripcion }}
                    </p>
                </div>
            </div>

            <a href="{{ route('tareas.index') }}"
               class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-white/20 hover:bg-white/30 rounded-xl transition
                      focus-visible:ring-2 focus-visible:ring-white">

                <span class="material-symbols-outlined" aria-hidden="true" focusable="false">arrow_back</span>

                Volver a Tareas
            </a>

        </div>

    </div>

    {{-- Formulario --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

        {{-- Cabecera --}}
        <div class="bg-gray-50 border-b border-gray-200 px-6 py-4">
            <h2 class="text-lg font-semibold text-gray-800">
                Nueva Tarea
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Registra una nueva tarea y asígnala a una categoría y a un responsable.
            </p>
        </div>

        <form action="{{ route('tareas.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            {{-- Título --}}
            <div>
                <label for="titulo" class="block text-sm font-medium text-gray-700 mb-2">
                    Título <span class="text-red-600" aria-hidden="true">*</span>
                </label>
                <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" required
                    placeholder="Ej. Crear módulo de tareas"
                    aria-invalid="{{ $errors->has('titulo') ? 'true' : 'false' }}"
                    @if($errors->has('titulo')) aria-describedby="titulo-error" @endif
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 text-gray-900 placeholder:text-gray-500
                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition
                           @error('titulo') border-red-500 @enderror">
                @error('titulo')
                    <p id="titulo-error" role="alert" class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Descripción --}}
            <div>
                <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-2">
                    Descripción <span class="text-red-600" aria-hidden="true">*</span>
                </label>
                <textarea name="descripcion" id="descripcion" rows="4" required
                    placeholder="Escribe la descripción de la tarea"
                    aria-invalid="{{ $errors->has('descripcion') ? 'true' : 'false' }}"
                    @if($errors->has('descripcion')) aria-describedby="descripcion-error" @endif
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 text-gray-900 placeholder:text-gray-500
                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition
                           @error('descripcion') border-red-500 @enderror">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <p id="descripcion-error" role="alert" class="text-red-600 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                {{-- Categoría --}}
                <div>
                    <label for="categoria_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Categoría <span class="text-red-600" aria-hidden="true">*</span>
                    </label>
                    <select name="categoria_id" id="categoria_id" required
                        aria-invalid="{{ $errors->has('categoria_id') ? 'true' : 'false' }}"
                        @if($errors->has('categoria_id')) aria-describedby="categoria-error" @endif
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 text-gray-900 bg-white
                               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition
                               @error('categoria_id') border-red-500 @enderror">
                        <option value="" {{ old('categoria_id') ? '' : 'selected' }} disabled>
                            -- Seleccionar categoría --
                        </option>
                        @forelse ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->name }}
                            </option>
                        @empty
                            <option value="" disabled>No hay categorías registradas. Crea una primero.</option>
                        @endforelse
                    </select>
                    @error('categoria_id')
                        <p id="categoria-error" role="alert" class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Usuario --}}
                <div>
                    <label for="usuario_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Usuario Asignado <span class="text-red-600" aria-hidden="true">*</span>
                    </label>
                    <select name="usuario_id" id="usuario_id" required
                        aria-invalid="{{ $errors->has('usuario_id') ? 'true' : 'false' }}"
                        @if($errors->has('usuario_id')) aria-describedby="usuario-error" @endif
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 text-gray-900 bg-white
                               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition
                               @error('usuario_id') border-red-500 @enderror">
                        <option value="" {{ old('usuario_id') ? '' : 'selected' }} disabled>
                            -- Seleccionar usuario --
                        </option>
                        @foreach ($usuarios as $usuario)
                            <option value="{{ $usuario->id }}"
                                {{ old('usuario_id', auth()->id()) == $usuario->id ? 'selected' : '' }}>
                                {{ $usuario->user_name ?? $usuario->email }}
                            </option>
                        @endforeach
                    </select>
                    @error('usuario_id')
                        <p id="usuario-error" role="alert" class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <p class="text-xs text-gray-500">
                <span class="text-red-600" aria-hidden="true">*</span> Campo obligatorio.
                La tarea se creará con el estado <strong>Pendiente</strong>.
            </p>

            {{-- Botones --}}
            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-gray-200">

                <a href="{{ route('tareas.index') }}"
                   class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl transition">
                    <span class="material-symbols-outlined text-sm" aria-hidden="true" focusable="false">close</span>
                    Cancelar
                </a>

                <button type="submit"
                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-green-700 hover:bg-green-800 text-white font-medium rounded-xl shadow-sm transition">
                    <span class="material-symbols-outlined text-sm" aria-hidden="true" focusable="false">add_circle</span>
                    Guardar Tarea
                </button>

            </div>
        </form>

    </div>

</div>

@endsection
