@extends('layouts.base')

@section('body')

<div class="min-h-screen supports-[min-height:100dvh]:min-h-[100dvh] lg:grid lg:grid-cols-[1.05fr_1fr]">

    {{-- Panel editorial: marca y propuesta --}}
    <aside class="relative hidden overflow-hidden bg-ink p-12 text-white lg:flex lg:flex-col lg:justify-between">

        {{-- Retícula sutil de "escritorio" --}}
        <div class="pointer-events-none absolute inset-0 opacity-[0.55]"
             style="background-image: linear-gradient(rgba(255,255,255,0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.05) 1px, transparent 1px); background-size: 48px 48px;"
             aria-hidden="true"></div>

        <div class="relative z-10 flex items-center gap-3">
            <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-brand-500" aria-hidden="true">
                <span class="material-symbols-outlined text-[22px]" aria-hidden="true" focusable="false">task_alt</span>
            </span>
            <span class="font-display text-2xl leading-none tracking-tight">TaskFlow</span>
        </div>

        <div class="relative z-10 my-auto max-w-md">
            <p class="mb-5 flex items-center gap-3 text-xs font-semibold text-brand-200">
                <span class="h-px w-8 bg-brand-500" aria-hidden="true"></span>
                Escritorio personal
            </p>

            <p class="font-display text-5xl leading-[1.05] tracking-tight text-white">
                Tus tareas,<br>
                <span class="italic text-brand-200">en orden.</span>
            </p>

            <p class="mt-5 max-w-sm text-base leading-relaxed text-white/70">
                Un espacio privado para capturar lo que importa, moverlo con claridad y cerrar el día con la lista en paz.
            </p>

            <ul class="mt-10 space-y-4 border-t border-white/10 pt-6 text-sm text-white/70">
                <li class="flex items-start gap-3">
                    <span class="mt-0.5 flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-white/10 text-[10px] font-semibold text-brand-200" aria-hidden="true">01</span>
                    Privado por diseño: solo tú ves tus tareas.
                </li>
                <li class="flex items-start gap-3">
                    <span class="mt-0.5 flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-white/10 text-[10px] font-semibold text-brand-200" aria-hidden="true">02</span>
                    Estados claros: pendiente, en progreso y completada.
                </li>
                <li class="flex items-start gap-3">
                    <span class="mt-0.5 flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-white/10 text-[10px] font-semibold text-brand-200" aria-hidden="true">03</span>
                    Papelera con retorno: nada se pierde por accidente.
                </li>
            </ul>
        </div>

        <p class="relative z-10 text-xs text-white/60">
            &copy; {{ date('Y') }} TaskFlow. Todos los derechos reservados.
        </p>
    </aside>

    {{-- Formulario --}}
    <main id="contenido"
         tabindex="-1"
         class="flex min-h-screen items-center justify-center bg-canvas px-4 py-10 pb-[max(2.5rem,env(safe-area-inset-bottom))] outline-none sm:px-8 lg:min-h-0">

        <div class="w-full max-w-[440px]">

            {{-- Marca en móvil --}}
            <div class="mb-8 text-center lg:hidden">
                <span class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-brand-600 text-white shadow-card" aria-hidden="true">
                    <span class="material-symbols-outlined text-[24px]" aria-hidden="true" focusable="false">task_alt</span>
                </span>
                <p class="font-display text-3xl leading-none tracking-tight text-ink">TaskFlow</p>
                <p class="mt-2 text-sm text-muted">Tus tareas, en orden.</p>
            </div>

            <div class="rounded-2xl border border-line bg-surface p-6 shadow-card sm:p-8">
                @yield('content')
            </div>

            <p class="mt-6 text-center text-xs text-muted">
                Tus datos permanecen en tu espacio privado de TaskFlow.
            </p>
        </div>
    </main>

</div>

@endsection
