@extends('layouts.guest')

@section('title', 'Crear cuenta · TaskFlow')

@section('content')

<div class="w-full">

    {{-- ENCABEZADO --}}
    <div class="text-center mb-8">

        <div class="w-16 h-16 mx-auto rounded-2xl bg-green-100 flex items-center justify-center mb-4" aria-hidden="true">
            <span class="material-symbols-outlined text-3xl text-green-700" aria-hidden="true" focusable="false">person_add</span>
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
        <div role="alert" class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-700">

            <div class="flex items-center gap-2 mb-2">
                <span class="material-symbols-outlined" aria-hidden="true" focusable="false">error</span>

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

            <label for="user_name" class="block text-sm font-medium text-gray-700 mb-2">
                Usuario <span class="text-red-600" aria-hidden="true">*</span>
            </label>

            <input
                id="user_name"
                type="text"
                name="user_name"
                value="{{ old('user_name') }}"
                required
                autocomplete="username"
                aria-invalid="{{ $errors->has('user_name') ? 'true' : 'false' }}"
                @if($errors->has('user_name')) aria-describedby="user_name-error" @endif
                placeholder="Ingrese un nombre de usuario"
                class="w-full rounded-xl border border-gray-300 px-4 py-3 text-gray-900 placeholder:text-gray-500
                       focus:border-green-600 focus:ring-2 focus:ring-green-200 outline-none transition
                       @error('user_name') border-red-500 @enderror">

            @error('user_name')
                <p id="user_name-error" class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror

        </div>

        {{-- EMAIL --}}
        <div>

            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                Correo Electrónico
                <span class="text-gray-500 text-xs">(opcional)</span>
            </label>

            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                autocomplete="email"
                aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
                @if($errors->has('email')) aria-describedby="email-error" @endif
                placeholder="correo@ejemplo.com"
                class="w-full rounded-xl border border-gray-300 px-4 py-3 text-gray-900 placeholder:text-gray-500
                       focus:border-green-600 focus:ring-2 focus:ring-green-200 outline-none transition
                       @error('email') border-red-500 @enderror">

            @error('email')
                <p id="email-error" class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror

        </div>

        {{-- CONTRASEÑA --}}
        <div>

            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                Contraseña <span class="text-red-600" aria-hidden="true">*</span>
            </label>

            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
                @if($errors->has('password')) aria-describedby="password-error password-hint" @endif
                placeholder="Mínimo 8 caracteres"
                class="w-full rounded-xl border border-gray-300 px-4 py-3 text-gray-900 placeholder:text-gray-500
                       focus:border-green-600 focus:ring-2 focus:ring-green-200 outline-none transition
                       @error('password') border-red-500 @enderror">

            <p id="password-hint" class="mt-2 text-xs text-gray-500">
                Usa al menos 8 caracteres.
            </p>

            @error('password')
                <p id="password-error" class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror

        </div>

        {{-- CONFIRMAR CONTRASEÑA --}}
        <div>

            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                Confirmar Contraseña <span class="text-red-600" aria-hidden="true">*</span>
            </label>

            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="Repita la contraseña"
                class="w-full rounded-xl border border-gray-300 px-4 py-3 text-gray-900 placeholder:text-gray-500
                       focus:border-green-600 focus:ring-2 focus:ring-green-200 outline-none transition">

        </div>

        {{-- BOTÓN --}}
        <button
            type="submit"
            class="w-full bg-green-700 hover:bg-green-800 text-white font-medium py-3 rounded-xl transition shadow-sm">

            Crear Cuenta

        </button>

    </form>

    {{-- LOGIN --}}
    <div class="text-center mt-6">

        <span class="text-gray-500">
            ¿Ya tienes una cuenta?
        </span>

        <a href="{{ route('login') }}"
           class="text-green-700 hover:text-green-800 font-medium ml-1">
            Inicia sesión
        </a>

    </div>

</div>

@endsection
