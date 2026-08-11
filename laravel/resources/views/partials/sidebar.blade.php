<!--<div
    class="sidebar-panel top-0 bottom-0 fixed w-[250px] z-50 transition-transform duration-300 ease-in-out flex flex-col"
    style="background:#e8a7a7; border-right:1px solid #e4f0e9; box-shadow:2px 0 12px rgba(0,40,20,0.06);">

    <div class="flex items-center gap-3 px-5 h-[67px] flex-shrink-0"
        style="border-bottom:1px solid #e4f0e9;">
        <a href="" class="flex items-center gap-2.5 min-w-0">
            <div class="w-8 h-8 rounded-lg bg-white overflow-hidden flex-shrink-0 flex items-center justify-center p-1"
                style="border:1px solid #e4f0e9; box-shadow:0 1px 4px rgba(0,30,15,0.08);">
                <img src="" alt="Logo" class="w-full h-full object-contain">
            </div>
            <div class="flex items-baseline gap-1.5 min-w-0">
                <span class="text-md font-bold tracking-tight" style="color:#155537;">PRUEBITA</span>
                <span class="text-[11px] font-medium text-gray-400">v1</span>
            </div>
        </a>
    </div>

    <div class="flex-1 overflow-y-auto py-3 px-3 custom-scrollbar">
  

    </div>

    <div class="flex-shrink-0 px-4 py-3" style="border-top:1px solid #e4f0e9;">
        <p class="text-xs text-center font-medium" style="color:#b0ccb8;">
            Consultoría Ambiental
        </p>
    </div>

</div>

-->

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
                       bg-blue-600
                       flex-shrink-0
                       flex items-center justify-center
                       shadow-sm">


                <span 
                    class="material-symbols-outlined">settings_heart</span>


            </div>


            {{-- NOMBRE --}}
            <div class="flex items-baseline gap-1.5 min-w-0">

                <span
                    class="text-[17px]
                           font-bold
                           tracking-tight
                           text-gray-900">

                    PRUEBITA

                </span>

                <span
                    class="text-[11px]
                           font-medium
                           text-gray-400">

                    v1

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
        <a href="#"
            class="flex items-center gap-3
           w-full
           px-3 py-2.5
           mb-1
           rounded-lg
           bg-blue-50
           text-blue-600
           font-semibold
           text-sm">

            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2">
                <rect x="3" y="3" width="7" height="7" />
                <rect x="14" y="3" width="7" height="7" />
                <rect x="3" y="14" width="7" height="7" />
                <rect x="14" y="14" width="7" height="7" />
            </svg>

            <span>
                Dashboard
            </span>

        </a>



        {{-- VENTAS --}}
        <a href="#"
            class="flex items-center gap-3
           w-full px-3 py-2.5 mb-1
           rounded-lg
           text-gray-600
           hover:bg-gray-50
           hover:text-blue-600
           text-sm">

            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2">
                <path d="M3 3h18v18H3z" />
                <path d="M7 16v-3" />
                <path d="M12 16V8" />
                <path d="M17 16v-6" />
            </svg>

            <span>Ventas</span>

        </a>


        {{-- CLIENTES --}}
        <a href="#"
            class="flex items-center gap-3
           w-full px-3 py-2.5 mb-1
           rounded-lg
           text-gray-600
           hover:bg-gray-50
           hover:text-blue-600
           text-sm">

            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2">
                <circle cx="9" cy="7" r="4" />
                <path d="M3 21v-2a6 6 0 0 1 12 0v2" />
                <path d="M16 3.5a4 4 0 0 1 0 7" />
                <path d="M21 21v-2a6 6 0 0 0-4-5.65" />
            </svg>

            <span>Clientes</span>

        </a>


        <!-- {{-- PRODUCTOS --}}
        <a
            href="#"
            class="flex items-center gap-3
                   px-3 py-2.5
                   mb-1
                   rounded-lg
                   text-gray-600
                   hover:bg-gray-50
                   hover:text-blue-600
                   text-sm
                   font-medium
                   transition-all">

            <span
                class="material-symbols-outlined
                       text-[20px]">

                inventory_2

            </span>

            <span>
                Productos
            </span>

        </a>



        {{-- INVENTARIO --}}
        <a
            href="#"
            class="flex items-center gap-3
                   px-3 py-2.5
                   mb-1
                   rounded-lg
                   text-gray-600
                   hover:bg-gray-50
                   hover:text-blue-600
                   text-sm
                   font-medium
                   transition-all">

            <span
                class="material-symbols-outlined
                       text-[20px]">

                warehouse

            </span>

            <span>
                Inventario
            </span>

        </a>



        {{-- REPORTES --}}
        <a
            href="#"
            class="flex items-center gap-3
                   px-3 py-2.5
                   mb-1
                   rounded-lg
                   text-gray-600
                   hover:bg-gray-50
                   hover:text-blue-600
                   text-sm
                   font-medium
                   transition-all">

            <span
                class="material-symbols-outlined
                       text-[20px]">

                bar_chart

            </span>

            <span>
                Reportes
            </span>

        </a>



        {{-- CONFIGURACIÓN --}}
        <a
            href="#"
            class="flex items-center gap-3
                   px-3 py-2.5
                   mb-1
                   rounded-lg
                   text-gray-600
                   hover:bg-gray-50
                   hover:text-blue-600
                   text-sm
                   font-medium
                   transition-all">

            <span
                class="material-symbols-outlined
                       text-[20px]">

                settings

            </span>

            <span>
                Configuración
            </span>

        </a>


    </div>


    {{-- PARTE INFERIOR --}}
    <div
        class="flex-shrink-0
               px-4 py-4
               border-t border-gray-100">


        <div
            class="flex items-center gap-3
                   rounded-xl
                   bg-gray-50
                   px-3 py-3">


            {{-- AVATAR --}}
            <div
                class="w-9 h-9
                       rounded-full
                       bg-blue-100
                       flex items-center justify-center
                       text-xs font-bold
                       text-blue-600
                       flex-shrink-0">

                MR

            </div>


            {{-- INFO --}}
            <div class="min-w-0">

                <p
                    class="text-sm
                           font-semibold
                           text-gray-800
                           truncate">

                    Manuel

                </p>

                <p
                    class="text-xs
                           text-gray-400
                           truncate">

                    Administrador

                </p> -->

    </div>

</div>


</div>

</div>
