@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-start justify-start h-full">
        <div>
        <h1 class="text-2xl font-bold text-gray-800">{{ $titulo }}</h1>
        <p class="font-bold">{{ $descripcion }}</p>
        </div>
        <a href="{{route('categorias.create')}}">
            <button class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Crear Categoria
        </a>
    </div>
@endsection
