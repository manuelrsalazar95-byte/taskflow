
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />

<header
    class="fixed
           top-0
           right-0
           left-[250px]
           h-[67px]
           bg-white
           border-b
           border-gray-200
           z-40">

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
                       transition">

                <span class="material-symbols-outlined text-[22px]">
                    menu
                </span>

            </button>

            {{-- BUSCADOR --}}
            <div class="relative hidden sm:block">

                <span
                    class="material-symbols-outlined
                           absolute
                           left-3
                           top-1/2
                           -translate-y-1/2
                           text-gray-400">
                    search
                </span>

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
                           focus:ring-blue-100">

                <div
                    class="absolute
                           right-2
                           top-1/2
                           -translate-y-1/2
                           flex gap-1">

                    <span
                        class="text-[10px]
                               text-gray-400
                               border
                               border-gray-200
                               rounded
                               px-1.5
                               py-0.5">
                        ⌘
                    </span>

                    <span
                        class="text-[10px]
                               text-gray-400
                               border
                               border-gray-200
                               rounded
                               px-1.5
                               py-0.5">
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
                       hover:bg-gray-50">

                <span class="material-symbols-outlined">
                    dark_mode
                </span>

            </button>

            {{-- NOTIFICACIONES --}}
            <button
                class="relative
                       w-10 h-10
                       rounded-full
                       border border-gray-200
                       flex items-center justify-center
                       text-gray-500
                       hover:bg-gray-50">

                <span class="material-symbols-outlined">
                    notifications
                </span>

                <span
                    class="absolute
                           top-1.5
                           right-1.5
                           w-2
                           h-2
                           rounded-full
                           bg-orange-400
                           border-2
                           border-white"></span>

            </button>

            {{-- USUARIO --}}
            <button
                class="flex items-center gap-3
                       ml-1
                       px-2
                       py-1
                       rounded-xl
                       hover:bg-gray-50">

                <div
                    class="w-10 h-10
                           rounded-full
                           bg-blue-100
                           text-blue-600
                           flex items-center justify-center
                           text-sm
                           font-bold">
                    MR
                </div>

                <div class="hidden lg:block text-left">

                    <p class="text-sm font-semibold text-gray-800">
                        {{ Auth::user()->user_name }}
                    </p>

                    <p class="text-xs text-gray-400">
                        Administrador
                    </p>

                </div>

                <span class="material-symbols-outlined text-gray-500">
                    keyboard_arrow_down
                </span>

            </button>

            {{-- LOGOUT --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    type="submit"
                    class="bg-blue-500
                           hover:bg-blue-700
                           text-white
                           p-2
                           rounded-lg
                           flex
                           items-center
                           justify-center">

                    <span class="material-symbols-outlined">
                        logout
                    </span>

                </button>

            </form>

        </div>

    </div>

</header>