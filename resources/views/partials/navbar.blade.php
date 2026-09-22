<header class="fixed top-0 right-0 left-0 md:left-[260px] h-[67px] bg-white border-b border-gray-200 z-40">
    <div class="h-full px-4 md:px-6 flex items-center justify-between">

        {{-- IZQUIERDA --}}
        <div class="flex items-center gap-4">

            {{-- ABRIR MENÚ (solo móvil) --}}
            <button type="button"
                    id="sidebar-open"
                    aria-label="Abrir menú de navegación"
                    aria-controls="sidebar"
                    aria-expanded="false"
                    class="md:hidden w-10 h-10 flex items-center justify-center rounded-lg
                           text-gray-500 hover:bg-gray-100 transition">
                <span class="material-symbols-outlined text-[22px]" aria-hidden="true" focusable="false">menu</span>
            </button>

            {{-- BUSCADOR --}}
            <form action="{{ route('tareas.index') }}" method="GET" role="search" class="relative hidden sm:block">
                <label for="buscar-nav" class="sr-only">Buscar tareas por título o descripción</label>
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-500"
                      aria-hidden="true" focusable="false">search</span>

                <input
                    type="search"
                    id="buscar-nav"
                    name="buscar"
                    value="{{ request('buscar') }}"
                    placeholder="Buscar tareas..."
                    class="w-[320px] h-10 rounded-lg border border-gray-300 bg-white pl-10 pr-4
                           text-sm text-gray-700 placeholder:text-gray-500
                           focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition">
            </form>

        </div>

        {{-- DERECHA --}}
        <div class="flex items-center gap-3">

            {{-- NOTIFICACIONES / TAREAS --}}
            <a href="{{ route('tareas.index') }}"
               aria-label="Ir al listado de tareas"
               class="relative w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center
                      text-gray-500 hover:bg-gray-50 transition">
                <span class="material-symbols-outlined" aria-hidden="true" focusable="false">notifications</span>
            </a>

            {{-- USUARIO Y DROPDOWN --}}
            <div class="relative">
                <button type="button"
                        id="user-dropdown-btn"
                        aria-haspopup="true"
                        aria-expanded="false"
                        aria-controls="user-dropdown-menu"
                        class="flex items-center gap-3 ml-1 px-2 py-1 rounded-xl hover:bg-gray-50 transition">

                    <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-sm font-bold"
                         aria-hidden="true">
                        {{ strtoupper(substr(Auth::user()->user_name ?? 'U', 0, 2)) }}
                    </div>

                    <div class="hidden lg:block text-left">
                        <p class="text-sm font-semibold text-gray-800">
                            {{ Auth::user()->user_name }}
                        </p>
                        <p class="text-xs text-gray-500">
                            {{ Auth::user()->email ?? 'Sin email' }}
                        </p>
                    </div>

                    <span class="material-symbols-outlined text-gray-500" aria-hidden="true" focusable="false">keyboard_arrow_down</span>

                </button>

                {{-- Menú desplegable de usuario --}}
                <div id="user-dropdown-menu"
                     class="hidden absolute right-0 mt-2 w-56 rounded-2xl bg-white shadow-xl border border-gray-100 py-2 z-50">
                    <div class="px-4 py-3 border-b border-gray-100">
                        <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->user_name }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->email ?? 'Sin email' }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full text-left px-4 py-2.5 text-sm font-medium text-red-700 hover:bg-red-50 flex items-center gap-2 transition">
                            <span class="material-symbols-outlined text-[18px]" aria-hidden="true" focusable="false">logout</span>
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>

        </div>

    </div>
</header>

{{-- Fondo oscuro del menú móvil --}}
<div id="sidebar-overlay"
     class="fixed inset-0 bg-black/40 z-40 hidden md:hidden"
     aria-hidden="true"></div>

<script>
    // --- Menú lateral en móvil ---
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const btnOpen = document.getElementById('sidebar-open');
    const btnClose = document.getElementById('sidebar-close');

    function openSidebar() {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
        btnOpen.setAttribute('aria-expanded', 'true');
        btnClose.focus();
    }

    function closeSidebar() {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        btnOpen.setAttribute('aria-expanded', 'false');
        btnOpen.focus();
    }

    btnOpen.addEventListener('click', openSidebar);
    btnClose.addEventListener('click', closeSidebar);
    overlay.addEventListener('click', closeSidebar);

    // --- Menú desplegable de usuario ---
    const ddBtn = document.getElementById('user-dropdown-btn');
    const ddMenu = document.getElementById('user-dropdown-menu');

    function closeDropdown() {
        ddMenu.classList.add('hidden');
        ddBtn.setAttribute('aria-expanded', 'false');
    }

    ddBtn.addEventListener('click', function () {
        const isOpen = !ddMenu.classList.contains('hidden');
        ddMenu.classList.toggle('hidden');
        ddBtn.setAttribute('aria-expanded', String(!isOpen));
    });

    document.addEventListener('click', function (e) {
        if (!e.target.closest('#user-dropdown-btn') && !e.target.closest('#user-dropdown-menu')) {
            closeDropdown();
        }
    });

    // --- Cerrar con la tecla Escape (WCAG 2.1.2, sin trampas de teclado) ---
    document.addEventListener('keydown', function (e) {
        if (e.key !== 'Escape') return;

        if (!ddMenu.classList.contains('hidden')) {
            closeDropdown();
            ddBtn.focus();
        } else if (window.innerWidth < 768 && !overlay.classList.contains('hidden')) {
            closeSidebar();
        }
    });

    // Al cambiar a escritorio, restablecer el estado del menú móvil
    window.addEventListener('resize', function () {
        if (window.innerWidth >= 768) {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.add('hidden');
            btnOpen.setAttribute('aria-expanded', 'false');
        } else if (!overlay.classList.contains('hidden')) {
            sidebar.classList.add('-translate-x-full');
        }
    });
</script>
