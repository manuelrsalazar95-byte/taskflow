@extends('layouts.guest')
@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-4">Iniciar Sesión</h1>
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">Por favor, corrige los siguientes errores:</span>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4">
            <label for="user_name" class="block text-gray-700 text-sm font-bold mb-2">Nombre de Usuario</label>
            <input id="user_name" type="text"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                name="user_name" value="{{ old('user_name') }}" required autofocus>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Contraseña</label>
            <input id="password" type="password"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                name="password" required>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Iniciar Sesión
            </button>
        </div>
        <div class="mt-4">
            <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-700">¿No tienes una cuenta? Regístrate</a>
    </form>
@endsection
