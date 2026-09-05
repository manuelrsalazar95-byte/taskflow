@extends('layouts.app') {{-- Cambia por tu layout principal si es diferente --}}

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center gap-3 mb-6">
            <div class="p-2 bg-blue-100 rounded-lg text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <h1 class="text-xl font-bold text-gray-800">Crear Tarea</h1>
                <p class="text-sm text-gray-500">Registra una nueva tarea.</p>
            </div>
        </div>

        <form action="{{ route('tareas.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Título -->
            <div>
                <label for="titulo" class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                <input type="text" name="titulo" id="titulo" value="{{ old('titulo') }}" required
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('titulo') border-red-500 @enderror"
                    placeholder="Ej. Crear módulo de tareas">
                @error('titulo')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Descripción -->
            <div>
                <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="3" required
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('descripcion') border-red-500 @enderror"
                    placeholder="Escribe la descripción de la tarea">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Categoría -->
            <div>
                <label for="categoria_id" class="block text-sm font-medium text-gray-900 mb-1">Categoría</label>
                <select name="categoria_id" id="categoria_id" required
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('categoria_id') border-red-500 @enderror">
                    <option value="" disabled selected>-- Seleccionar categoría --</option>
                    @forelse ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->name ?? $categoria->titulo }}
                        </option>
                    @empty
                        <option value="" disabled>No hay categorías registradas. Crea una primero.</option>
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
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('usuario_id') border-red-500 @enderror">
                    <option value="" disabled selected>-- Seleccionar usuario --</option>
                    @foreach ($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" 
                            {{ old('usuario_id', auth()->id()) == $usuario->id ? 'selected' : '' }}>
                            {{ $usuario->name ?? $usuario->user_name ?? $usuario->email }}
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
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="pendiente" {{ old('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="en_progreso" {{ old('estado') == 'en_progreso' ? 'selected' : '' }}>En progreso</option>
                    <option value="completada" {{ old('estado') == 'completada' ? 'selected' : '' }}>Completada</option>
                </select>
            </div>

            <!-- Botones -->
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('tareas.index') }}" class="px-4 py-2 border text-gray-600 rounded-md hover:bg-gray-50">
                    Cancelar
                </a>
                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-md hover:bg-emerald-700">
                    Guardar Tarea
                </button>
            </div>
        </form>
    </div>
</div>
@endsection