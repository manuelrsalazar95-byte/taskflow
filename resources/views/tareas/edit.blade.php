@extends('layouts.app') {{-- Cambia por tu layout si aplica --}}

@section('content')
    <div class="container mx-auto p-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-2 bg-amber-100 rounded-lg text-amber-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-gray-800">Editar Tarea</h1>
                    <p class="text-sm text-gray-500">Actualiza la información de la tarea.</p>
                </div>
            </div>

            <form action="{{ route('tareas.update', $tarea->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Título -->
                <div>
                    <label for="titulo" class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                    <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $tarea->titulo) }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-900 bg-white">
                    @error('titulo')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Descripción -->
                <div>
                    <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                    <textarea name="descripcion" id="descripcion" rows="3" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-900 bg-white">{{ old('descripcion', $tarea->descripcion) }}</textarea>
                    @error('descripcion')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Categoría -->
                <div>
                    <label for="categoria_id" class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                    <select name="categoria_id" id="categoria_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-900 bg-white">
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" class="text-gray-900 bg-white"
                                {{ old('categoria_id', $tarea->categoria_id) == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('categoria_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Usuario -->
                <div>
                    <label for="usuario_id" class="block text-sm font-medium text-gray-700 mb-1">Usuario Asignado</label>
                    <select name="usuario_id" id="usuario_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-900 bg-white">
                        @foreach ($usuarios as $usuario)
                            <option value="{{ $usuario->id }}" class="text-gray-900 bg-white"
                                {{ old('usuario_id', $tarea->usuario_id) == $usuario->id ? 'selected' : '' }}>
                                {{ $usuario->name ?? ($usuario->user_name ?? $usuario->email) }}
                            </option>
                        @endforeach
                    </select>
                    @error('usuario_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Estado -->
                <div>
                    <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                    <select name="estado" id="estado" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-900 bg-white">
                        <option value="pendiente" {{ old('estado', $tarea->estado) == 'pendiente' ? 'selected' : '' }}>
                            Pendiente</option>
                        <option value="en_progreso" {{ old('estado', $tarea->estado) == 'en_progreso' ? 'selected' : '' }}>
                            En progreso</option>
                        <option value="completada" {{ old('estado', $tarea->estado) == 'completada' ? 'selected' : '' }}>
                            Completada</option>
                    </select>
                </div>

                <!-- Botones de Acción -->
                <div
                    style="display: flex; justify-content: flex-end; align-items: center; gap: 12px; margin-top: 24px; padding-top: 16px; border-top: 1px solid #e5e7eb;">
                    <a href="{{ route('tareas.index') }}"
                        style="display: inline-block; padding: 8px 16px; font-size: 14px; font-weight: 500; color: #374151; background-color: #ffffff; border: 1px solid #d1d5db; border-radius: 6px; text-decoration: none; text-align: center;">
                        Cancelar
                    </a>

                    <button type="submit"
                        style="display: inline-block; padding: 8px 16px; font-size: 14px; font-weight: 600; color: #ffffff !important; background-color: #d97706 !important; border: 1px solid #b45309; border-radius: 6px; cursor: pointer;">
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
