@props([
    'title',
    'subtitle' => null,
    'eyebrow' => null,
    'icon' => 'task_alt',
])

<header class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div class="flex items-start gap-4">
        <span class="hidden h-11 w-11 items-center justify-center rounded-xl bg-brand-50 text-brand-700 ring-1 ring-brand-100 sm:flex"
              aria-hidden="true">
            <span class="material-symbols-outlined text-[22px]" aria-hidden="true" focusable="false">{{ $icon }}</span>
        </span>

        <div class="min-w-0">
            @if ($eyebrow)
                <p class="mb-2 flex items-center gap-2 text-xs font-semibold text-brand-700">
                    <span class="h-px w-6 bg-brand-500" aria-hidden="true"></span>
                    {{ $eyebrow }}
                </p>
            @endif

            <h1 class="font-display text-3xl leading-tight tracking-tight text-ink sm:text-4xl">
                {{ $title }}
            </h1>

            @if ($subtitle)
                <p class="mt-1 max-w-2xl text-sm text-muted">{{ $subtitle }}</p>
            @endif
        </div>
    </div>

    @if (! $slot->isEmpty())
        <div class="flex flex-wrap items-center gap-2">
            {{ $slot }}
        </div>
    @endif
</header>
