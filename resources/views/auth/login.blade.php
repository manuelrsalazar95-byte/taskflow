@extends('layouts.guest')

@section('content')

<div class="w-full">

    {{-- ENCABEZADO --}}
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            Iniciar Sesión
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Ingresa tus credenciales para acceder a tu panel
        </p>
    </div>

    {{-- ERRORES GENERALES / ALERTA --}}
    @if ($errors->any())
        <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-700 flex items-start gap-3">
            <span class="material-symbols-outlined text-red-500 mt-0.5">
                error
            </span>
            <div class="text-sm">
                <span class="font-semibold block mb-1">Credenciales incorrectas o datos faltantes</span>
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
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                    <span class="material-symbols-outlined text-[20px]">person</span>
                </div>
                <input
                    id="user_name"
                    type="text"
                    name="user_name"
                    value="{{ old('user_name') }}"
                    required
                    autofocus
                    placeholder="Ingrese su usuario"
                    class="w-full rounded-xl border border-gray-300 pl-10 pr-4 py-3 text-gray-900 bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition @error('user_name') border-red-500 ring-2 ring-red-100 @enderror">
            </div>
            @error('user_name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- CONTRASEÑA --}}
        <div>
            <div class="flex items-center justify-between mb-1.5">
                <label for="password" class="block text-sm font-medium text-gray-700">
                    Contraseña
                </label>
            </div>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                    <span class="material-symbols-outlined text-[20px]">lock</span>
                </div>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    placeholder="Ingrese su contraseña"
                    class="w-full rounded-xl border border-gray-300 pl-10 pr-12 py-3 text-gray-900 bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition @error('password') border-red-500 ring-2 ring-red-100 @enderror">
                <button
                    type="button"
                    onclick="togglePassword()"
                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                    <span id="toggle-icon" class="material-symbols-outlined text-[20px]">visibility</span>
                </button>
            </div>
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- RECORDARME --}}
        <div class="flex items-center justify-between text-sm pt-1">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="remember" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <span class="text-gray-600 select-none">Recordarme</span>
            </label>
        </div>

        {{-- BOTON --}}
        <button
            type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-medium py-3 rounded-xl transition shadow-md shadow-blue-500/20 mt-2">
            Iniciar Sesión
        </button>

    </form>

    {{-- REGISTRO --}}
    <div class="text-center mt-6 pt-6 border-t border-gray-100">
        <span class="text-gray-500 text-sm">
            ¿No tienes una cuenta?
        </span>
        <a href="{{ route('register') }}"
            class="text-blue-600 hover:text-blue-700 font-semibold text-sm ml-1">
            Regístrate aquí
        </a>
    </div>

</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggle-icon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.textContent = 'visibility_off';
        } else {
            passwordInput.type = 'password';
            toggleIcon.textContent = 'visibility';
        }
    }
</script>

@endsection
