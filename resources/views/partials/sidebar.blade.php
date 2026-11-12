@php
    $isDashboard = request()->routeIs('dashboard');
    $isCategorias = request()->routeIs('categorias.*');
    $isTareas = request()->routeIs('tareas.*') && ! request()->routeIs('tareas.trash');
    $isTrash = request()->routeIs('tareas.trash');

    $linkBase = 'group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-colors duration-150';
    $linkActive = 'bg-brand-50 text-brand-700';
    $linkIdle = 'text-muted hover:bg-canvas hover:text-ink';

    $iconBase = 'material-symbols-outlined text-[20px] transition-colors';
@endphp

<aside id="sidebar"
       class="fixed inset-y-0 left-0 z-50 flex w-[264px] -translate-x-full flex-col border-r border-line bg-surface transition-transform duration-300 ease-in-out lg:translate-x-0"
       aria-label="Navegación principal">

    {{-- Marca --}}
    <div class="flex h-16 flex-shrink-0 items-center gap-3 border-b border-line px-5">
        <a href="{{ route('dashboard') }}"
           class="flex min-w-0 items-center gap-2.5 rounded-lg"
           aria-label="TaskFlow, ir al dashboard">
            <span class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-xl bg-brand-600 text-white shadow-card"
                  aria-hidden="true">
                <span class="material-symbols-outlined text-[20px]" aria-hidden="true" focusable="false">task_alt</span>
            </span>

            <span class="flex min-w-0 items-baseline gap-1.5">
                <span class="font-display text-[22px] leading-none tracking-tight text-ink">TaskFlow</span>
                <span class="rounded bg-canvas px-1.5 py-0.5 text-[10px] font-semibold text-muted ring-1 ring-line" aria-hidden="true">v1.3</span>
            </span>
        </a>

        <button type="button"
                id="sidebar-close"
                class="ml-auto flex h-10 w-10 items-center justify-center rounded-lg text-muted transition hover:bg-canvas hover:text-ink lg:hidden"
                aria-label="Cerrar menú de navegación">
            <span class="material-symbols-outlined text-[22px]" aria-hidden="true" focusable="false">close</span>
        </button>
    </div>

    {{-- Navegación --}}
    <div class="tf-scrollbar flex-1 space-y-7 overflow-y-auto px-3 py-6">

        <nav aria-labelledby="nav-principal-label">
            <p id="nav-principal-label" class="mb-2 px-3 text-xs font-semibold text-muted">Espacio de trabajo</p>

            <div class="space-y-1">
                <a href="{{ route('dashboard') }}"
                   @if ($isDashboard) aria-current="page" @endif
                   class="{{ $linkBase }} {{ $isDashboard ? $linkActive : $linkIdle }}">
                    <span class="{{ $iconBase }} {{ $isDashboard ? 'text-brand-600' : 'text-muted group-hover:text-ink' }}"
                          aria-hidden="true" focusable="false">dashboard</span>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('tareas.index') }}"
                   @if ($isTareas) aria-current="page" @endif
                   class="{{ $linkBase }} {{ $isTareas ? $linkActive : $linkIdle }}">
                    <span class="{{ $iconBase }} {{ $isTareas ? 'text-brand-600' : 'text-muted group-hover:text-ink' }}"
                          aria-hidden="true" focusable="false">task_alt</span>
                    <span>Tareas</span>
                </a>

                <a href="{{ route('categorias.index') }}"
                   @if ($isCategorias) aria-current="page" @endif
                   class="{{ $linkBase }} {{ $isCategorias ? $linkActive : $linkIdle }}">
                    <span class="{{ $iconBase }} {{ $isCategorias ? 'text-brand-600' : 'text-muted group-hover:text-ink' }}"
                          aria-hidden="true" focusable="false">folder</span>
                    <span>Categorías</span>
                </a>
            </div>
        </nav>

        <nav aria-labelledby="nav-sistema-label">
            <p id="nav-sistema-label" class="mb-2 px-3 text-xs font-semibold text-muted">Sistema</p>

            <div class="space-y-1">
                <a href="{{ route('tareas.trash') }}"
                   @if ($isTrash) aria-current="page" @endif
                   class="{{ $linkBase }} {{ $isTrash ? $linkActive : $linkIdle }}">
                    <span class="{{ $iconBase }} {{ $isTrash ? 'text-brand-600' : 'text-muted group-hover:text-ink' }}"
                          aria-hidden="true" focusable="false">delete_sweep</span>
                    <span>Papelera</span>
                </a>
            </div>
        </nav>
    </div>

    {{-- Pie: recordatorio de privacidad --}}
    <div class="border-t border-line p-3">
        <div class="flex items-start gap-2.5 rounded-xl bg-canvas px-3 py-3">
            <span class="material-symbols-outlined mt-0.5 text-[18px] text-muted" aria-hidden="true" focusable="false">lock</span>
            <p class="text-xs leading-relaxed text-muted">
                Espacio privado. Solo tú ves tus tareas y categorías.
            </p>
        </div>
    </div>
</aside>
