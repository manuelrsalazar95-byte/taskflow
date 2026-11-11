{{-- Mensajes flash. Los controladores ya envían ->with('success', ...) y ->with('error', ...) --}}
@if (session('success'))
    <div role="status"
         aria-live="polite"
         class="mb-5 flex items-start gap-3 rounded-xl border border-success-200 bg-success-50 px-4 py-3 animate-fade-up">
        <span class="material-symbols-outlined mt-0.5 text-[20px] text-success-600" aria-hidden="true" focusable="false">check_circle</span>

        <p class="flex-1 text-sm font-medium text-success-700">{{ session('success') }}</p>

        <button type="button"
                data-dismiss-flash
                class="-m-1 flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg text-success-700/70 transition hover:bg-success-100 hover:text-success-700"
                aria-label="Cerrar mensaje">
            <span class="material-symbols-outlined text-[18px]" aria-hidden="true" focusable="false">close</span>
        </button>
    </div>
@endif

@if (session('error'))
    <div role="alert"
         class="mb-5 flex items-start gap-3 rounded-xl border border-danger-200 bg-danger-50 px-4 py-3 animate-fade-up">
        <span class="material-symbols-outlined mt-0.5 text-[20px] text-danger-600" aria-hidden="true" focusable="false">error</span>

        <p class="flex-1 text-sm font-medium text-danger-700">{{ session('error') }}</p>

        <button type="button"
                data-dismiss-flash
                class="-m-1 flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg text-danger-700/70 transition hover:bg-danger-100 hover:text-danger-700"
                aria-label="Cerrar mensaje">
            <span class="material-symbols-outlined text-[18px]" aria-hidden="true" focusable="false">close</span>
        </button>
    </div>
@endif
