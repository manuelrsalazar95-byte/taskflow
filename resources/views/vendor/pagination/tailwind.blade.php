@if ($paginator->hasPages())
    <nav role="navigation"
         aria-label="Paginación"
         class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

        <p class="text-xs text-muted">
            Mostrando
            <span class="font-medium text-ink tabular-nums">{{ $paginator->firstItem() }}</span>–<span class="font-medium text-ink tabular-nums">{{ $paginator->lastItem() }}</span>
            de
            <span class="font-medium text-ink tabular-nums">{{ $paginator->total() }}</span>
            {{ $paginator->total() === 1 ? 'resultado' : 'resultados' }}
        </p>

        <div class="flex items-center gap-1">

            {{-- Anterior --}}
            @if ($paginator->onFirstPage())
                <span aria-disabled="true"
                      aria-label="Página anterior"
                      class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-line text-muted/50">
                    <span class="material-symbols-outlined text-[18px]" aria-hidden="true" focusable="false">chevron_left</span>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   rel="prev"
                   aria-label="Página anterior"
                   class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-line text-muted transition hover:bg-canvas hover:text-ink">
                    <span class="material-symbols-outlined text-[18px]" aria-hidden="true" focusable="false">chevron_left</span>
                </a>
            @endif

            {{-- Páginas --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="inline-flex h-9 w-9 items-center justify-center text-xs text-muted" aria-hidden="true">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page"
                                  class="inline-flex h-9 min-w-9 items-center justify-center rounded-lg bg-brand-600 px-2 text-xs font-semibold text-white tabular-nums">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                               aria-label="Ir a la página {{ $page }}"
                               class="inline-flex h-9 min-w-9 items-center justify-center rounded-lg border border-line px-2 text-xs font-medium text-muted transition hover:bg-canvas hover:text-ink tabular-nums">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Siguiente --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   rel="next"
                   aria-label="Página siguiente"
                   class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-line text-muted transition hover:bg-canvas hover:text-ink">
                    <span class="material-symbols-outlined text-[18px]" aria-hidden="true" focusable="false">chevron_right</span>
                </a>
            @else
                <span aria-disabled="true"
                      aria-label="Página siguiente"
                      class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-line text-muted/50">
                    <span class="material-symbols-outlined text-[18px]" aria-hidden="true" focusable="false">chevron_right</span>
                </span>
            @endif

        </div>
    </nav>
@endif
