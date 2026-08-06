<nav class="navbar flex items-center h-[60px] mx-0 md:mx-6 mt-0 md:mt-2.5 px-3 md:px-4 z-30 md:rounded-md"
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