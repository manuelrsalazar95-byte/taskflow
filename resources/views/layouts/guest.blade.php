@extends('layouts.base')

@section('body')

<div class="min-h-screen grid grid-cols-1 lg:grid-cols-2 bg-slate-900">

    {{-- LADO IZQUIERDO: Branding & Visual Showcase --}}
    <div class="hidden lg:flex flex-col justify-between p-12 bg-gradient-to-br from-slate-950 via-indigo-950 to-blue-950 relative overflow-hidden text-white">
        <!-- Glowing Ambient Orbs -->
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-blue-600/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Logo / Top -->
        <div class="relative z-10 flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center shadow-lg shadow-blue-500/30" aria-hidden="true">
                <span class="material-symbols-outlined text-white text-2xl" aria-hidden="true" focusable="false">task_alt</span>
            </div>
            <span class="text-xl font-bold tracking-tight">TaskFlow</span>
        </div>

        <!-- Center Content -->
        <div class="relative z-10 max-w-lg space-y-6 my-auto">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-semibold tracking-wide uppercase">
                <span aria-hidden="true">🚀</span>
                <span>Productividad al siguiente nivel</span>
            </div>
            <h2 class="text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight">
                Organiza, prioriza y logra tus metas sin esfuerzo.
            </h2>
            <p class="text-slate-400 text-base leading-relaxed">
                TaskFlow te permite gestionar proyectos, asignar tareas y dar seguimiento al progreso de tu equipo en tiempo real con una interfaz ultrarrápida y moderna.
            </p>
        </div>

        <!-- Footer / Copyright -->
        <div class="relative z-10 text-xs text-slate-400">
            &copy; {{ date('Y') }} TaskFlow. Todos los derechos reservados.
        </div>
    </div>

    {{-- LADO DERECHO: Formulario (Login / Register) --}}
    <div id="contenido" tabindex="-1" class="flex items-center justify-center p-6 sm:p-12 bg-slate-50 relative outline-none">
        <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl border border-slate-200/80 p-8 sm:p-10">
            
            {{-- Mobile Logo Header --}}
            <div class="lg:hidden text-center mb-8">
                <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-blue-600 flex items-center justify-center shadow-lg shadow-blue-500/30" aria-hidden="true">
                    <span class="material-symbols-outlined text-white text-3xl" aria-hidden="true" focusable="false">task_alt</span>
                </div>
                <p class="text-2xl font-bold text-slate-900">TaskFlow</p>
                <p class="text-slate-500 text-sm mt-1">Gestiona tus tareas de manera simple</p>
            </div>

            @yield('content')

        </div>
    </div>

</div>

@endsection
