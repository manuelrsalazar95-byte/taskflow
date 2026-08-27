@extends('layouts.guest')

@section('content')

<div class="w-full">

    {{-- ENCABEZADO --}}
    <div class="text-center mb-8">

        <h1 class="text-3xl font-bold text-gray-800">
            Bienvenido
        </h1>

        <p class="text-gray-500 mt-2">
            Inicia sesión para continuar
        </p>

    </div>

    {{-- ERRORES --}}
    @if ($errors->any())
        <div
            class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-700">

            <div class="flex items-center gap-2 mb-2">
                <span class="material-symbols-outlined">
                    error
                </span>

                <span class="font-semibold">
                    Se encontraron errores
                </span>
            </div>

            <ul class="list-disc pl-6 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif

    {{-- FORMULARIO --}}
    <form method="POST" action="{{ route('login') }}" class="space-y-5">

        @csrf

        {{-- USUARIO --}}
        <div>

            <label for="user_name"
                class="block text-sm font-medium text-gray-700 mb-2">
                Usuario
            </label>

            <input
                id="user_name"
                type="text"
                name="user_name"
                value="{{ old('user_name') }}"
                required
                autofocus
                placeholder="Ingrese su usuario"
                class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition">

        </div>

        {{-- PASSWORD --}}
        <div>

            <label for="password"
                class="block text-sm font-medium text-gray-700 mb-2">
                Contraseña
            </label>

            <input
                id="password"
                type="password"
                name="password"
                required
                placeholder="Ingrese su contraseña"
                class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition">

        </div>

        {{-- BOTON --}}
        <button
            type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-xl transition shadow-sm">

            Iniciar Sesión

        </button>

    </form>

    {{-- REGISTRO --}}
    <div class="text-center mt-6">

        <span class="text-gray-500">
            ¿No tienes una cuenta?
        </span>

        <a href="{{ route('register') }}"
            class="text-blue-600 hover:text-blue-700 font-medium ml-1">
            Regístrate
        </a>

    </div>

</div>

@endsection