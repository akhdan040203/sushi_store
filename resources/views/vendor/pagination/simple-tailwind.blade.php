@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Simple Pagination Navigation" class="flex items-center justify-between gap-4 py-6 px-4 bg-zinc-900/40 border border-white/5 rounded-2xl">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="flex items-center gap-2 px-4 h-10 text-xs font-bold uppercase tracking-widest text-zinc-600 bg-zinc-950/30 border border-white/5 rounded-xl cursor-not-allowed">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
                Prev
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="flex items-center gap-2 px-4 h-10 text-xs font-bold uppercase tracking-widest text-zinc-400 hover:text-white bg-zinc-950/50 border border-white/10 hover:border-white/20 rounded-xl transition-all duration-300 shadow-lg shadow-black/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
                Prev
            </a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="flex items-center gap-2 px-4 h-10 text-xs font-bold uppercase tracking-widest text-zinc-400 hover:text-white bg-zinc-950/50 border border-white/10 hover:border-white/20 rounded-xl transition-all duration-300 shadow-lg shadow-black/20">
                Next
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
            </a>
        @else
            <span class="flex items-center gap-2 px-4 h-10 text-xs font-bold uppercase tracking-widest text-zinc-600 bg-zinc-950/30 border border-white/5 rounded-xl cursor-not-allowed">
                Next
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
            </span>
        @endif
    </nav>
@endif
