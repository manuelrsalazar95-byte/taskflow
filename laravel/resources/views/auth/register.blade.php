@extends('layouts.guest')

@section('content')

<div class="w-full">

    {{-- ENCABEZADO --}}
    <div class="text-center mb-8">

        <div class="w-16 h-16 mx-auto rounded-2xl bg-green-100 flex items-center justify-center mb-4">
            <span class="material-symbols-outlined text-3xl text-green-600">
                person_add
            </span>
        </div>

        <h1 class="text-3xl font-bold text-gray-800">
            Crear Cuenta
        </h1>

        <p class="text-gray-500 mt-2">
            Regístrate para comenzar a utilizar TaskFlow
        </p>

    </div>

    {{-- ERRORES --}}
    @if ($errors->any())
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-700">

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
    <form method="POST" action="{{ route('register') }}" class="space-y-5">

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
                placeholder="Ingrese un nombre de usuario"
                class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition">

        </div>

        {{-- CONTRASEÑA --}}
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
                placeholder="Ingrese una contraseña"
                class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition">

        </div>

        {{-- CONFIRMAR CONTRASEÑA --}}
        <div>

            <label for="password_confirmation"
                class="block text-sm font-medium text-gray-700 mb-2">
                Confirmar Contraseña
            </label>

            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                required
                placeholder="Repita la contraseña"
                class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition">

        </div>

        {{-- BOTÓN --}}
        <button
            type="submit"
            class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-3 rounded-xl transition shadow-sm">

            Crear Cuenta

        </button>

    </form>

    {{-- LOGIN --}}
    <div class="text-center mt-6">

        <span class="text-gray-500">
            ¿Ya tienes una cuenta?
        </span>

        <a href="{{ route('login') }}"
            class="text-green-600 hover:text-green-700 font-medium ml-1">
            Inicia sesión
        </a>

    </div>

</div>

@endsection