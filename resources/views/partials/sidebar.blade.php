<div
    class="sidebar-panel fixed top-0 bottom-0 left-0
           w-[250px] z-50
           bg-white
           border-r border-gray-200
           flex flex-col
           transition-transform duration-300 ease-in-out">


    {{-- LOGO --}}
    <div
        class="flex items-center gap-3
               px-5 h-[67px]
               flex-shrink-0
               border-b border-gray-100">

        <a href="" class="flex items-center gap-2.5 min-w-0">

            {{-- ICONO LOGO --}}
            <div
                class="w-9 h-9 rounded-xl
                       bg-blue-400
                       flex-shrink-0
                       flex items-center justify-center
                       shadow-sm">


                <span class="material-symbols-outlined">settings_heart</span>


            </div>


            {{-- NOMBRE --}}
            <div class="flex items-baseline gap-1.5 min-w-0">

                <span
                    class="text-[17px]
                           font-bold
                           tracking-tight
                           text-gray-900">

                    Pruebita

                </span>

                <span
                    class="text-[11px]
                           font-medium
                           text-gray-400">

                    v1.1

                </span>


            </div>

        </a>

    </div>



    {{-- MENU --}}
    <div
        class="flex-1
               overflow-y-auto
               py-5
               px-3
               custom-scrollbar">


        {{-- TITULO MENU --}}
        <p
            class="px-3 mb-3
                   text-[11px]
                   font-semibold
                   uppercase
                   tracking-wider
                   text-gray-400">

            MENU

        </p>

        {{-- DASHBOARD --}}
        <a href={{ route('dashboard') }}
            class="flex items-center gap-3
    w-full
    px-3 py-2.5
    mb-1
    rounded-lg
    bg-blue-50
    text-blue-600
    font-semibold
    text-sm">

            <span class="w-5 text-center text-base">📊</span>

            <span>Dashboard</span>

        </a>

        {{-- CATEGORÍAS --}}
        <a href="{{ route('categorias.index') }}"
            class="flex items-center gap-3
    w-full px-3 py-3 mb-2
    rounded-xl
    text-gray-600
    hover:bg-blue-50
    hover:text-blue-600
    transition-all duration-200
    text-sm font-medium">

            <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100">
                📁
            </span>

            <span>Categorías</span>

        </a>

        {{-- TAREAS --}}
        <a href="{{ route('tareas.index') }}"
            class="flex items-center gap-3
    w-full px-3 py-2.5 mb-1
    rounded-lg
    text-gray-600
    hover:bg-gray-50
    hover:text-blue-600
    text-sm">

            <span class="w-5 text-center text-base">📝</span>

            <span>Tareas</span>

        </a>


    </div>

</div>



