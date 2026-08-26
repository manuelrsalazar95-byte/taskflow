@extends('layouts.app')

@section('content')
    <div class="flex items-start justify-between h-full">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                <span class="material-symbols-outlined">
                    category_search
                </span>{{ $titulo }}
            </h1>
            <p class="font-bold">{{ $descripcion }}</p>
        </div>
        <a href="{{ route('categorias.create') }}">
            <button class="mt-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Crear Categoria
        </a>
    </div>

    <div>
        <table class="table-auto w-full mt-4 border border-gray-300 rounded-lg overflow-hidden">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b text-left text-sm font-medium text-black">ID</th>
                    <th class="px-6 py-3 border-b text-left text-sm font-medium text-black">Nombre</th>
                    <th class="px-6 py-3 border-b text-left text-sm font-medium text-black">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($model as $x)
                    <tr>
                        <td class="px-6 py-4 border-b">{{ $x->id }}</td>
                        <td class="px-6 py-4 border-b">{{ $x->name }}</td>
                        <td class="px-6 py-4 border-b">
                            <a href="{{ route('categorias.edit', $x->id) }}"
                                class="text-blue-500 hover:text-blue-700 mr-2">Editar</a>

                            <form action="{{ route('categorias.destroy', $x->id) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700"
                                    onclick="return confirm('¿Estás seguro de eliminar esta categoría?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-6 py-8 border-b text-center text-gray-500 italic" colspan="4">
                            No hay categorías registradas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
