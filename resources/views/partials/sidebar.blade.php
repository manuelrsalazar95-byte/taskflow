<div
    class="sidebar-panel fixed top-0 bottom-0 left-0
           w-[260px] z-50
           bg-white
           border-r border-gray-200/80
           flex flex-col
           transition-transform duration-300 ease-in-out">


    {{-- LOGO --}}
    <div
        class="flex items-center gap-3
               px-6 h-[70px]
               flex-shrink-0
               border-b border-gray-100">

        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 min-w-0">

            {{-- ICONO LOGO --}}
            <div
                class="w-10 h-10 rounded-xl
                       bg-blue-600
                       flex-shrink-0
                       flex items-center justify-center
                       shadow-md shadow-blue-500/30">

                <span class="material-symbols-outlined text-white text-xl">task_alt</span>

            </div>

            {{-- NOMBRE --}}
            <div class="flex items-baseline gap-1.5 min-w-0">

                <span
                    class="text-[17px]
                           font-bold
                           tracking-tight
                           text-gray-900">

                    TaskFlow

                </span>

                <span
                    class="text-[10px]
                           font-semibold
                           px-1.5 py-0.5
                           rounded-md
                           bg-blue-50
                           text-blue-600">

                    v1.3

                </span>

            </div>

        </a>

    </div>



    {{-- MENU --}}
    <div
        class="flex-1
               overflow-y-auto
               py-6
               px-4
               space-y-6
               custom-scrollbar">


        @php
            $isDashboard = request()->routeIs('dashboard');
            $isCategorias = request()->routeIs('categorias.*');
            $isTareas = request()->routeIs('tareas.*') && !request()->routeIs('tareas.trash');
            $isTrash = request()->routeIs('tareas.trash');
        @endphp

        {{-- SECCIÓN PRINCIPAL --}}
        <div>
            <p class="px-3 mb-3 text-[11px] font-bold uppercase tracking-wider text-gray-400">
                Menú Principal
            </p>

            <nav class="space-y-1">
                {{-- DASHBOARD --}}
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 w-full px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ $isDashboard ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <span class="w-8 h-8 flex items-center justify-center rounded-lg {{ $isDashboard ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-600' }}">
                        <span class="material-symbols-outlined text-[20px]">dashboard</span>
                    </span>
                    <span>Dashboard</span>
                </a>

                {{-- CATEGORÍAS --}}
                <a href="{{ route('categorias.index') }}"
                    class="flex items-center gap-3 w-full px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ $isCategorias ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <span class="w-8 h-8 flex items-center justify-center rounded-lg {{ $isCategorias ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-600' }}">
                        <span class="material-symbols-outlined text-[20px]">folder</span>
                    </span>
                    <span>Categorías</span>
                </a>

                {{-- TAREAS --}}
                <a href="{{ route('tareas.index') }}"
                    class="flex items-center gap-3 w-full px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ $isTareas ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <span class="w-8 h-8 flex items-center justify-center rounded-lg {{ $isTareas ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-600' }}">
                        <span class="material-symbols-outlined text-[20px]">task_alt</span>
                    </span>
                    <span>Tareas</span>
                </a>
            </nav>
        </div>


        {{-- SECCIÓN GESTIÓN --}}
        <div>
            <p class="px-3 mb-3 text-[11px] font-bold uppercase tracking-wider text-gray-400">
                Sistema
            </p>

            <nav class="space-y-1">
                {{-- PAPELERA --}}
                <a href="{{ route('tareas.trash') }}"
                    class="flex items-center gap-3 w-full px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ $isTrash ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-gray-600 hover:bg-slate-100 hover:text-slate-900' }}">
                    <span class="w-8 h-8 flex items-center justify-center rounded-lg {{ $isTrash ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-600' }}">
                        <span class="material-symbols-outlined text-[20px]">delete_sweep</span>
                    </span>
                    <span>Papelera</span>
                </a>
            </nav>
        </div>


    </div>

</div>
