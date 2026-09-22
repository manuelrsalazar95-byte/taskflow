<div id="sidebar"
     class="sidebar-panel fixed top-0 bottom-0 left-0
            w-[260px] z-50
            bg-white
            border-r border-gray-200/80
            flex flex-col
            -translate-x-full md:translate-x-0
            transition-transform duration-300 ease-in-out">

    {{-- LOGO --}}
    <div class="flex items-center gap-3 px-6 h-[70px] flex-shrink-0 border-b border-gray-100">

        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 min-w-0"
           aria-label="TaskFlow, ir al dashboard">

            {{-- ICONO LOGO --}}
            <div class="w-10 h-10 rounded-xl bg-blue-600 flex-shrink-0 flex items-center justify-center shadow-md shadow-blue-500/30"
                 aria-hidden="true">
                <span class="material-symbols-outlined text-white text-xl" aria-hidden="true" focusable="false">task_alt</span>
            </div>

            {{-- NOMBRE --}}
            <div class="flex items-baseline gap-1.5 min-w-0">
                <span class="text-[17px] font-bold tracking-tight text-gray-900">TaskFlow</span>
                <span class="text-[10px] font-semibold px-1.5 py-0.5 rounded-md bg-blue-50 text-blue-600" aria-hidden="true">v1.3</span>
            </div>

        </a>

        {{-- CERRAR (solo móvil) --}}
        <button type="button"
                id="sidebar-close"
                class="ml-auto md:hidden w-10 h-10 flex items-center justify-center rounded-lg
                       text-gray-500 hover:bg-gray-100 transition"
                aria-label="Cerrar menú de navegación">
            <span class="material-symbols-outlined text-[22px]" aria-hidden="true" focusable="false">close</span>
        </button>

    </div>



    {{-- MENU --}}
    <div class="flex-1 overflow-y-auto py-6 px-4 space-y-6 custom-scrollbar">

        @php
            $isDashboard = request()->routeIs('dashboard');
            $isCategorias = request()->routeIs('categorias.*');
            $isTareas = request()->routeIs('tareas.*') && !request()->routeIs('tareas.trash');
            $isTrash = request()->routeIs('tareas.trash');
        @endphp

        {{-- SECCIÓN PRINCIPAL --}}
        <div>
            <p id="nav-principal-label" class="px-3 mb-3 text-[11px] font-bold uppercase tracking-wider text-gray-500">
                Menú Principal
            </p>

            <nav class="space-y-1" aria-labelledby="nav-principal-label">
                {{-- DASHBOARD --}}
                <a href="{{ route('dashboard') }}"
                   @if($isDashboard) aria-current="page" @endif
                   class="flex items-center gap-3 w-full px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ $isDashboard ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <span class="w-8 h-8 flex items-center justify-center rounded-lg {{ $isDashboard ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-600' }}" aria-hidden="true">
                        <span class="material-symbols-outlined text-[20px]" aria-hidden="true" focusable="false">dashboard</span>
                    </span>
                    <span>Dashboard</span>
                </a>

                {{-- CATEGORÍAS --}}
                <a href="{{ route('categorias.index') }}"
                   @if($isCategorias) aria-current="page" @endif
                   class="flex items-center gap-3 w-full px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ $isCategorias ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <span class="w-8 h-8 flex items-center justify-center rounded-lg {{ $isCategorias ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-600' }}" aria-hidden="true">
                        <span class="material-symbols-outlined text-[20px]" aria-hidden="true" focusable="false">folder</span>
                    </span>
                    <span>Categorías</span>
                </a>

                {{-- TAREAS --}}
                <a href="{{ route('tareas.index') }}"
                   @if($isTareas) aria-current="page" @endif
                   class="flex items-center gap-3 w-full px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ $isTareas ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <span class="w-8 h-8 flex items-center justify-center rounded-lg {{ $isTareas ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-600' }}" aria-hidden="true">
                        <span class="material-symbols-outlined text-[20px]" aria-hidden="true" focusable="false">task_alt</span>
                    </span>
                    <span>Tareas</span>
                </a>
            </nav>
        </div>


        {{-- SECCIÓN SISTEMA --}}
        <div>
            <p id="nav-sistema-label" class="px-3 mb-3 text-[11px] font-bold uppercase tracking-wider text-gray-500">
                Sistema
            </p>

            <nav class="space-y-1" aria-labelledby="nav-sistema-label">
                {{-- PAPELERA --}}
                <a href="{{ route('tareas.trash') }}"
                   @if($isTrash) aria-current="page" @endif
                   class="flex items-center gap-3 w-full px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ $isTrash ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <span class="w-8 h-8 flex items-center justify-center rounded-lg {{ $isTrash ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-600' }}" aria-hidden="true">
                        <span class="material-symbols-outlined text-[20px]" aria-hidden="true" focusable="false">delete_sweep</span>
                    </span>
                    <span>Papelera</span>
                </a>
            </nav>
        </div>

    </div>

</div>
