@extends('layouts.app')

@section('content')
    <div class="flex items-start justify-between h-full">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                <span class="material-symbols-outlined">
                    category
                </span>{{ $titulo }}
            </h1>
            <p class="font-bold">{{ $descripcion }}</p>
        </div>
        <a href="{{ route('categorias.index') }}"
             class="mt-4 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                Volver a Categorias
        </a>
    </div>

    <div class="mt-4">
        <form method="POST" action="{{ route('categorias.store') }}">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nombre de la categoría</label>
                <input type="text" name="name" id="name" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    name="name" value="{{ old('name') }}" required autofocus>
            </div>

            <div>
                <button type="submit"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Crear Categoria
                </button>
            </div>
        </form>
    </div>
@endsection