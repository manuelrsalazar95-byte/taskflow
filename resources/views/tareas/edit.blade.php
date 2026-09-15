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
                        @forelse ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" class="text-gray-900 bg-white"
                                {{ old('categoria_id', $tarea->categoria_id) == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->name }}
                            </option>
                        @empty
                            <option value="" disabled>No hay categorías registradas.</option>
                        @endforelse
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
                        @forelse ($usuarios as $usuario)
                            <option value="{{ $usuario->id }}" class="text-gray-900 bg-white"
                                {{ old('usuario_id', $tarea->usuario_id) == $usuario->id ? 'selected' : '' }}>
                                {{ $usuario->name ?? ($usuario->user_name ?? $usuario->email) }}
                            </option>
                        @empty
                            <option value="" disabled>No hay usuarios registrados.</option>
                        @endforelse
                    </select>
                    @error('usuario_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botones de Acción -->
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                    <a href="{{ route('tareas.index') }}"
                        class="px-4 py-2 border text-gray-600 rounded-md hover:bg-gray-50">
                        Cancelar
                    </a>

                    <button type="submit"
                        class="px-4 py-2 bg-amber-600 text-white rounded-md hover:bg-amber-700">
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
