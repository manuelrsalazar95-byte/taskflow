@extends('layouts.guest')

@section('title', 'Iniciar sesión · TaskFlow')

@section('content')

<header class="mb-6">
    <p class="mb-2 flex items-center gap-2 text-xs font-semibold text-brand-700">
        <span class="h-px w-6 bg-brand-500" aria-hidden="true"></span>
        Acceso
    </p>

    <h1 class="font-display text-4xl leading-none tracking-tight text-ink">Hola de nuevo</h1>
    <p class="mt-2 text-sm text-muted">Entra para continuar donde lo dejaste.</p>
</header>

@if ($errors->any())
    <div class="mb-5">
        <x-ui.error-summary />
    </div>
@endif

<form method="POST" action="{{ route('login') }}" class="space-y-4" data-pending-form>
    @csrf

    {{-- Usuario --}}
    <div>
        <label for="user_name" class="mb-1.5 block text-sm font-medium text-ink">
            Usuario <span class="text-danger-600" aria-hidden="true">*</span>
        </label>

        <input
            id="user_name"
            type="text"
            name="user_name"
            value="{{ old('user_name') }}"
            required
            autocomplete="username"
            placeholder="Tu nombre de usuario"
            aria-invalid="{{ $errors->has('user_name') ? 'true' : 'false' }}"
            @if ($errors->has('user_name')) aria-describedby="user_name-error" @endif
            class="w-full rounded-xl border bg-surface px-3.5 py-2.5 text-sm text-ink placeholder:text-muted transition focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-100
                   @error('user_name') border-danger-500 ring-2 ring-danger-100 @else border-field @enderror">

        @error('user_name')
            <p id="user_name-error" role="alert" class="mt-1.5 text-xs font-medium text-danger-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Contraseña --}}
    <div>
        <label for="password" class="mb-1.5 block text-sm font-medium text-ink">
            Contraseña <span class="text-danger-600" aria-hidden="true">*</span>
        </label>

        <div class="relative">
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Tu contraseña"
                aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
                @if ($errors->has('password')) aria-describedby="password-error" @endif
                class="w-full rounded-xl border bg-surface py-2.5 pl-3.5 pr-12 text-sm text-ink placeholder:text-muted transition focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-100
                       @error('password') border-danger-500 ring-2 ring-danger-100 @else border-field @enderror">

            <button type="button"
                    data-toggle-password
                    data-target="password"
                    aria-label="Mostrar contraseña"
                    aria-pressed="false"
                    class="absolute right-1 top-1/2 flex h-9 w-9 -translate-y-1/2 items-center justify-center rounded-lg text-muted transition hover:bg-canvas hover:text-ink">
                <span data-toggle-icon class="material-symbols-outlined text-[20px]" aria-hidden="true" focusable="false">visibility</span>
            </button>
        </div>

        @error('password')
            <p id="password-error" role="alert" class="mt-1.5 text-xs font-medium text-danger-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Recordarme --}}
    <div class="pt-1">
        {{-- p-2 -m-2 amplía el área táctil sin cambiar el diseño (WCAG 2.2) --}}
        <label for="remember" class="-m-2 flex cursor-pointer items-center gap-2.5 p-2">
            <input type="checkbox"
                   id="remember"
                   name="remember"
                   value="1"
                   class="h-5 w-5 rounded border-field text-brand-600 focus:ring-2 focus:ring-brand-500 focus:ring-offset-2">
            <span class="select-none text-sm text-muted">Recordarme en este equipo</span>
        </label>
    </div>

    <button type="submit"
            class="mt-2 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-brand-600 px-5 py-3 text-sm font-semibold text-white shadow-card transition hover:bg-brand-700 active:bg-brand-800 disabled:pointer-events-none disabled:opacity-60">
        Iniciar sesión
    </button>
</form>

<div class="mt-6 border-t border-line pt-5 text-center text-sm">
    <span class="text-muted">¿Aún no tienes cuenta?</span>
    <a href="{{ route('register') }}" class="ml-1 font-semibold text-brand-700 underline-offset-4 hover:underline">
        Crear una cuenta
    </a>
</div>

@endsection
