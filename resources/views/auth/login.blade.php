@extends('layouts.guest')

@section('title', 'Iniciar sesión · TaskFlow')

@section('content')

<div class="w-full">

    {{-- ENCABEZADO --}}
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Iniciar Sesión
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Ingresa tus credenciales para acceder a tu panel
        </p>
    </div>

    {{-- ERRORES GENERALES / ALERTA --}}
    @if ($errors->any())
        <div role="alert"
             class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-700 flex items-start gap-3">
            <span class="material-symbols-outlined text-red-600 mt-0.5" aria-hidden="true" focusable="false">error</span>
            <div class="text-sm">
                <span class="font-semibold block mb-1">Revisa los siguientes datos</span>
                <ul class="list-disc pl-4 space-y-0.5 text-xs">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{-- FORMULARIO --}}
    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        {{-- USUARIO --}}
        <div>
            <label for="user_name" class="block text-sm font-medium text-gray-700 mb-1.5">
                Usuario
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-500" aria-hidden="true">
                    <span class="material-symbols-outlined text-[20px]" aria-hidden="true" focusable="false">person</span>
                </div>
                <input
                    id="user_name"
                    type="text"
                    name="user_name"
                    value="{{ old('user_name') }}"
                    required
                    autocomplete="username"
                    aria-invalid="{{ $errors->has('user_name') ? 'true' : 'false' }}"
                    @if($errors->has('user_name')) aria-describedby="user_name-error" @endif
                    placeholder="Ingrese su usuario"
                    class="w-full rounded-xl border border-gray-300 pl-10 pr-4 py-3 text-gray-900 bg-white
                           placeholder:text-gray-500
                           focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition
                           @error('user_name') border-red-500 ring-2 ring-red-100 @enderror">
            </div>
            @error('user_name')
                <p id="user_name-error" class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- CONTRASEÑA --}}
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">
                Contraseña
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-500" aria-hidden="true">
                    <span class="material-symbols-outlined text-[20px]" aria-hidden="true" focusable="false">lock</span>
                </div>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
                    @if($errors->has('password')) aria-describedby="password-error" @endif
                    placeholder="Ingrese su contraseña"
                    class="w-full rounded-xl border border-gray-300 pl-10 pr-12 py-3 text-gray-900 bg-white
                           placeholder:text-gray-500
                           focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition
                           @error('password') border-red-500 ring-2 ring-red-100 @enderror">
                <button
                    type="button"
                    id="toggle-password"
                    aria-label="Mostrar contraseña"
                    aria-pressed="false"
                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-500 hover:text-gray-700
                           focus-visible:ring-2 focus-visible:ring-blue-600 rounded-r-xl">
                    <span id="toggle-icon" class="material-symbols-outlined text-[20px]" aria-hidden="true" focusable="false">visibility</span>
                </button>
            </div>
            @error('password')
                <p id="password-error" class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- RECORDARME --}}
        <div class="flex items-center justify-between text-sm pt-1">
            {{-- p-2 -m-2 amplía el área táctil sin cambiar el diseño (WCAG 2.2: target ≥24px) --}}
            <label for="remember" class="flex items-center gap-2 cursor-pointer p-2 -m-2">
                <input type="checkbox"
                       id="remember"
                       name="remember"
                       value="1"
                       class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <span class="text-gray-600 select-none">Recordarme</span>
            </label>
        </div>

        {{-- BOTON --}}
        <button
            type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-medium py-3 rounded-xl
                   transition shadow-md shadow-blue-500/20 mt-2">
            Iniciar Sesión
        </button>

    </form>

    {{-- REGISTRO --}}
    <div class="text-center mt-6 pt-6 border-t border-gray-100">
        <span class="text-gray-500 text-sm">
            ¿No tienes una cuenta?
        </span>
        <a href="{{ route('register') }}"
           class="text-blue-700 hover:text-blue-800 font-semibold text-sm ml-1">
            Regístrate aquí
        </a>
    </div>

</div>

<script>
    const toggleBtn = document.getElementById('toggle-password');
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggle-icon');

    toggleBtn.addEventListener('click', function () {
        const visible = passwordInput.type === 'text';
        passwordInput.type = visible ? 'password' : 'text';
        toggleIcon.textContent = visible ? 'visibility' : 'visibility_off';
        toggleBtn.setAttribute('aria-pressed', String(!visible));
        toggleBtn.setAttribute('aria-label', visible ? 'Mostrar contraseña' : 'Ocultar contraseña');
    });
</script>

@endsection
