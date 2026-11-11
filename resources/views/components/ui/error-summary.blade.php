@if ($errors->any())
    <div data-error-summary
         tabindex="-1"
         role="alert"
         class="rounded-xl border border-danger-200 bg-danger-50 px-4 py-3 focus:outline-none">
        <div class="flex items-start gap-3">
            <span class="material-symbols-outlined mt-0.5 text-danger-600" aria-hidden="true" focusable="false">error</span>

            <div class="text-sm text-danger-700">
                <p class="font-semibold">Revisa los campos marcados</p>

                <ul class="mt-1 list-disc space-y-0.5 pl-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif
