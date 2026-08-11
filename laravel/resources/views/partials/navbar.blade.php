<!--<nav class="navbar flex items-center h-[60px] mx-0 md:mx-6 mt-0 md:mt-2.5 px-3 md:px-4 z-30 md:rounded-md"
    style="border-bottom:1px solid #67746c; background:#cfa5a5; box-shadow:0 1px 8px rgba(0,40,20,0.04);">

    <div class="flex items-center gap-2.5 flex-1 min-w-0">

        <a href="" class="md:hidden flex items-center gap-2 flex-shrink-0">
            <div class="w-8 h-8 rounded-xl bg-white flex items-center justify-center shadow-sm p-1"
                style="border:1px solid #e4f0e9;">
                <img src="" alt="Logo"
                    class="w-full h-full object-contain">
            </div>
            <span class="text-base font-black tracking-tight" style="color:#155537;">PRUEBITA</span>
        </a>
        <button
            class="menubar hidden md:flex items-center justify-center w-9 h-9 rounded-xl transition-all active:scale-95 flex-shrink-0"
            style="color:#2d8a5e;"
            onmouseover="this.style.background='#f0faf4'"
            onmouseout="this.style.background='transparent'">
        </button>

    </div>
    <div class="flex items-center gap-1.5 flex-shrink-0">

        <div class="hidden sm:flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold"
            style="background:#f0faf4; border:1px solid #b0ddbe; color:#1f6b47;">
            <span class="relative flex h-[6px] w-[6px] flex-shrink-0">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-60"
                    style="background:#45ad75;"></span>
                <span class="relative inline-flex rounded-full h-[6px] w-[6px]"
                    style="background:#2d8a5e;"></span>
            </span>
            Activa
        </div>
       
        <button
            class="flex items-center justify-center w-9 h-9 rounded-xl transition-all duration-150 active:scale-95"
            style="border:1px solid #e4f0e9; color:#9ca3af;"
            onmouseover="this.style.background='#fff5f5'; this.style.color='#dc2626'; this.style.borderColor='#fecaca'"
            onmouseout="this.style.background='transparent'; this.style.color='#9ca3af'; this.style.borderColor='#e4f0e9'"
            title="Cerrar sesión">
            <span class="material-symbols-outlined text-[20px]">logout</span>
        </button>

        <div class="h-6 w-px mx-0.5" style="background:#e4f0e9;"></div>

        <div class="relative hidden md:block">

            <div id="navUserDropdown"
                class="hidden absolute top-full right-0 mt-2 w-64 bg-white rounded-2xl border border-gray-100 overflow-hidden z-50"
                style="box-shadow:0 8px 32px rgba(0,40,20,0.12);">
            </div>

        </div>


    </div>
</nav>
-->


<header
    class="fixed
           top-0
           right-0
           left-[250px]
           h-[67px]
           bg-white
           border-b
           border-gray-200
           z-40"
>

    <div class="h-full px-6 flex items-center justify-between">


        {{-- IZQUIERDA --}}
        <div class="flex items-center gap-4">


            {{-- MENU --}}
            <button
                class="w-10 h-10
                       flex items-center justify-center
                       rounded-lg
                       text-gray-500
                       hover:bg-gray-100
                       transition"
            >

                {{-- SVG --}}
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="22"
                    height="22"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <line x1="4" y1="6" x2="20" y2="6"/>
                    <line x1="4" y1="12" x2="20" y2="12"/>
                    <line x1="4" y1="18" x2="20" y2="18"/>
                </svg>

            </button>


            {{-- BUSCADOR --}}
            <div class="relative hidden sm:block">

                <svg
                    class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"
                    width="19"
                    height="19"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <circle cx="11" cy="11" r="7"/>
                    <path d="m20 20-4-4"/>
                </svg>


                <input
                    type="text"
                    placeholder="Search or type command..."
                    class="w-[320px]
                           h-10
                           rounded-lg
                           border border-gray-200
                           bg-white
                           pl-10
                           pr-16
                           text-sm
                           text-gray-700
                           placeholder:text-gray-400
                           outline-none
                           focus:border-blue-500
                           focus:ring-2
                           focus:ring-blue-100"
                >


                <div
                    class="absolute
                           right-2
                           top-1/2
                           -translate-y-1/2
                           flex gap-1"
                >

                    <span
                        class="text-[10px]
                               text-gray-400
                               border
                               border-gray-200
                               rounded
                               px-1.5
                               py-0.5"
                    >
                        ⌘
                    </span>

                    <span
                        class="text-[10px]
                               text-gray-400
                               border
                               border-gray-200
                               rounded
                               px-1.5
                               py-0.5"
                    >
                        K
                    </span>

                </div>

            </div>

        </div>



        {{-- DERECHA --}}
        <div class="flex items-center gap-3">


            {{-- DARK MODE --}}
            <button
                class="w-10 h-10
                       rounded-full
                       border border-gray-200
                       flex items-center justify-center
                       text-gray-500
                       hover:bg-gray-50"
            >

                {{-- Luna SVG --}}
                <svg
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        d="M21 12.79A9 9 0 1 1 11.21 3
                           7 7 0 0 0 21 12.79z"
                    />
                </svg>

            </button>


            {{-- NOTIFICACIONES --}}
            <button
                class="relative
                       w-10 h-10
                       rounded-full
                       border border-gray-200
                       flex items-center justify-center
                       text-gray-500
                       hover:bg-gray-50"
            >

                <svg
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        d="M18 8a6 6 0 0 0-12 0
                           c0 7-3 7-3 9h18c0-2-3-2-3-9"
                    />
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                </svg>


                <span
                    class="absolute
                           top-1.5
                           right-1.5
                           w-2
                           h-2
                           rounded-full
                           bg-orange-400
                           border-2
                           border-white"
                ></span>

            </button>


            {{-- USUARIO --}}
            <button
                class="flex items-center gap-3
                       ml-1
                       px-2
                       py-1
                       rounded-xl
                       hover:bg-gray-50"
            >

                <div
                    class="w-10 h-10
                           rounded-full
                           bg-blue-100
                           text-blue-600
                           flex items-center justify-center
                           text-sm
                           font-bold"
                >
                    MR
                </div>


                <div class="hidden lg:block text-left">

                    <p class="text-sm font-semibold text-gray-800">
                        Manuel
                    </p>

                    <p class="text-xs text-gray-400">
                        Administrador
                    </p>

                </div>


                {{-- FLECHA --}}
                <svg
                    width="18"
                    height="18"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path d="m6 9 6 6 6-6"/>
                </svg>

            </button>

        </div>

    </div>

</header>