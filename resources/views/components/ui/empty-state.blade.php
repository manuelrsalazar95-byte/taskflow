@props([
    'icon' => 'inbox',
    'title',
    'description' => null,
])

<div class="flex flex-col items-center justify-center px-6 py-14 text-center">
    <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-canvas text-muted ring-1 ring-line"
          aria-hidden="true">
        <span class="material-symbols-outlined text-[28px]" aria-hidden="true" focusable="false">{{ $icon }}</span>
    </span>

    <h3 class="mt-4 font-display text-2xl text-ink">{{ $title }}</h3>

    @if ($description)
        <p class="mt-1 max-w-sm text-sm text-muted">{{ $description }}</p>
    @endif

    @if (! $slot->isEmpty())
        <div class="mt-5 flex flex-wrap items-center justify-center gap-2">
            {{ $slot }}
        </div>
    @endif
</div>
