{{-- Mensajes flash de éxito (los controladores ya los envían con ->with('success', ...)) --}}
@if (session('success'))
    <div role="status"
         aria-live="polite"
         class="mb-6 flex items-start gap-3 rounded-2xl border border-green-200 bg-green-50 px-4 py-3">
        <span class="material-symbols-outlined text-green-700 mt-0.5" aria-hidden="true" focusable="false">check_circle</span>
        <p class="text-sm font-medium text-green-800">
            {{ session('success') }}
        </p>
    </div>
@endif

{{-- Mensajes flash de error (p. ej. categoría con tareas asociadas) --}}
@if (session('error'))
    <div role="alert"
         class="mb-6 flex items-start gap-3 rounded-2xl border border-red-200 bg-red-50 px-4 py-3">
        <span class="material-symbols-outlined text-red-600 mt-0.5" aria-hidden="true" focusable="false">error</span>
        <p class="text-sm font-medium text-red-700">
            {{ session('error') }}
        </p>
    </div>
@endif
