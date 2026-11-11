@extends('layouts.guest')

@section('title', 'Crear cuenta · TaskFlow')

@section('content')

<header class="mb-6">
    <p class="mb-2 flex items-center gap-2 text-xs font-semibold text-brand-700">
        <span class="h-px w-6 bg-brand-500" aria-hidden="true"></span>
        Nueva cuenta
    </p>

    <h1 class="font-display text-4xl leading-none tracking-tight text-ink">Crea tu espacio</h1>
    <p class="mt-2 text-sm text-muted">Un lugar privado para organizar lo que importa.</p>
</header>

@if ($errors->any())
    <div class="mb-5">
        <x-ui.error-summary />
    </div>
@endif

<form method="POST" action="{{ route('register') }}" class="space-y-4" data-pending-form>
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
            placeholder="Elige un nombre de usuario"
            aria-invalid="{{ $errors->has('user_name') ? 'true' : 'false' }}"
            @if ($errors->has('user_name')) aria-describedby="user_name-error" @endif
            class="w-full rounded-xl border bg-surface px-3.5 py-2.5 text-sm text-ink placeholder:text-muted transition focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-100
                   @error('user_name') border-danger-500 ring-2 ring-danger-100 @else border-field @enderror">

        @error('user_name')
            <p id="user_name-error" role="alert" class="mt-1.5 text-xs font-medium text-danger-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Email --}}
    <div>
        <label for="email" class="mb-1.5 block text-sm font-medium text-ink">
            Correo electrónico <span class="text-xs font-normal text-muted">(opcional)</span>
        </label>

        <input
            id="email"
            type="email"
            name="email"
            value="{{ old('email') }}"
            autocomplete="email"
            placeholder="correo@ejemplo.com"
            aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
            @if ($errors->has('email')) aria-describedby="email-error" @endif
            class="w-full rounded-xl border bg-surface px-3.5 py-2.5 text-sm text-ink placeholder:text-muted transition focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-100
                   @error('email') border-danger-500 ring-2 ring-danger-100 @else border-field @enderror">

        @error('email')
            <p id="email-error" role="alert" class="mt-1.5 text-xs font-medium text-danger-600">{{ $message }}</p>
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
                autocomplete="new-password"
                placeholder="Mínimo 8 caracteres"
                aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
                @if ($errors->has('password')) aria-describedby="password-error password-hint" @else aria-describedby="password-hint" @endif
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

        <p id="password-hint" class="mt-1.5 text-xs text-muted">Usa al menos 8 caracteres.</p>

        @error('password')
            <p id="password-error" role="alert" class="mt-1.5 text-xs font-medium text-danger-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- Confirmar contraseña --}}
    <div>
        <label for="password_confirmation" class="mb-1.5 block text-sm font-medium text-ink">
            Confirmar contraseña <span class="text-danger-600" aria-hidden="true">*</span>
        </label>

        <input
            id="password_confirmation"
            type="password"
            name="password_confirmation"
            required
            autocomplete="new-password"
            placeholder="Repite la contraseña"
            class="w-full rounded-xl border border-field bg-surface px-3.5 py-2.5 text-sm text-ink placeholder:text-muted transition focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-100">
    </div>

    <button type="submit"
            class="mt-2 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-brand-600 px-5 py-3 text-sm font-semibold text-white shadow-card transition hover:bg-brand-700 active:bg-brand-800 disabled:pointer-events-none disabled:opacity-60">
        Crear cuenta
    </button>
</form>

<div class="mt-6 border-t border-line pt-5 text-center text-sm">
    <span class="text-muted">¿Ya tienes una cuenta?</span>
    <a href="{{ route('login') }}" class="ml-1 font-semibold text-brand-700 underline-offset-4 hover:underline">
        Iniciar sesión
    </a>
</div>

@endsection
