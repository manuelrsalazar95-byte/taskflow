<header class="fixed left-0 right-0 top-0 z-40 h-16 border-b border-line bg-surface/95 backdrop-blur lg:left-[264px]">
    <div class="flex h-full items-center justify-between gap-4 px-4 sm:px-6">

        {{-- Izquierda: menú móvil + búsqueda --}}
        <div class="flex min-w-0 items-center gap-2 sm:gap-4">

            <button type="button"
                    id="sidebar-open"
                    aria-label="Abrir menú de navegación"
                    aria-controls="sidebar"
                    aria-expanded="false"
                    class="flex h-10 w-10 items-center justify-center rounded-lg text-muted transition hover:bg-canvas hover:text-ink lg:hidden">
                <span class="material-symbols-outlined text-[22px]" aria-hidden="true" focusable="false">menu</span>
            </button>

            <form action="{{ route('tareas.index') }}" method="GET" role="search" class="relative hidden sm:block">
                <label for="buscar-nav" class="sr-only">Buscar tareas por título o descripción</label>
                <span class="material-symbols-outlined pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-[20px] text-muted"
                      aria-hidden="true" focusable="false">search</span>

                <input type="search"
                       id="buscar-nav"
                       name="buscar"
                       value="{{ request('buscar') }}"
                       placeholder="Buscar tareas…"
                       class="h-10 w-[240px] rounded-xl border border-field bg-surface pl-10 pr-4 text-sm text-ink placeholder:text-muted transition focus:border-brand-500 focus:bg-surface focus:outline-none focus:ring-2 focus:ring-brand-100 lg:w-[320px]">
            </form>
        </div>

        {{-- Derecha: atajo a tareas + usuario --}}
        <div class="flex flex-shrink-0 items-center gap-1 sm:gap-2">

            <a href="{{ route('tareas.index') }}"
               aria-label="Ir al listado de tareas"
               class="flex h-10 w-10 items-center justify-center rounded-lg text-muted transition hover:bg-canvas hover:text-ink">
                <span class="material-symbols-outlined text-[21px]" aria-hidden="true" focusable="false">checklist</span>
            </a>

            <div class="relative">
                <button type="button"
                        id="user-dropdown-btn"
                        aria-label="Menú de cuenta de {{ Auth::user()->user_name }}"
                        aria-expanded="false"
                        aria-controls="user-dropdown-menu"
                        class="flex items-center gap-2.5 rounded-xl px-1.5 py-1.5 transition hover:bg-canvas sm:pl-2.5">
                    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-brand-50 text-xs font-semibold text-brand-700 ring-1 ring-brand-100"
                          aria-hidden="true">
                        {{ strtoupper(substr(Auth::user()->user_name ?? 'U', 0, 2)) }}
                    </span>

                    <span class="hidden min-w-0 text-left lg:block">
                        <span class="block max-w-[150px] truncate text-sm font-semibold leading-tight text-ink">{{ Auth::user()->user_name }}</span>
                        <span class="block max-w-[150px] truncate text-xs leading-tight text-muted">{{ Auth::user()->email ?? 'Sin email' }}</span>
                    </span>

                    <span class="material-symbols-outlined text-[20px] text-muted" aria-hidden="true" focusable="false">keyboard_arrow_down</span>
                </button>

                <div id="user-dropdown-menu"
                     class="absolute right-0 z-50 mt-2 hidden w-60 rounded-xl border border-line bg-surface py-1.5 shadow-lift">
                    <div class="border-b border-line px-4 py-3">
                        <p class="truncate text-sm font-semibold text-ink">{{ Auth::user()->user_name }}</p>
                        <p class="truncate text-xs text-muted">{{ Auth::user()->email ?? 'Sin email' }}</p>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="flex w-full items-center gap-2.5 px-4 py-2.5 text-sm font-medium text-danger-600 transition hover:bg-danger-50">
                            <span class="material-symbols-outlined text-[18px]" aria-hidden="true" focusable="false">logout</span>
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

{{-- Fondo del menú móvil --}}
<div id="sidebar-overlay"
     class="fixed inset-0 z-40 hidden bg-ink/40 backdrop-blur-[1px] lg:hidden"
     aria-hidden="true"></div>
