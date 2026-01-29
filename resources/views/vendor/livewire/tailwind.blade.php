@if ($paginator->hasPages())
    <div class="flex flex-col sm:flex-row items-center justify-between gap-6 py-8 px-6 bg-zinc-900/40 border border-white/5 rounded-3xl backdrop-blur-md">
        {{-- Summary (Left) --}}
        <div class="text-xs uppercase tracking-widest text-zinc-500 font-semibold">
            Showing 
            <span class="text-white">{{ $paginator->firstItem() ?? 0 }}</span> 
            - 
            <span class="text-white">{{ $paginator->lastItem() ?? 0 }}</span> 
            of 
            <span class="text-white">{{ $paginator->total() }}</span> 
            results
        </div>

        {{-- Navigation (Right) --}}
        <nav role="navigation" aria-label="Pagination Navigation">
            <ul class="flex items-center gap-2 p-1.5 bg-zinc-950/50 border border-white/5 rounded-2xl">
                {{-- Previous Page Link --}}
                <li>
                    @if ($paginator->onFirstPage())
                        <span class="flex items-center justify-center w-10 h-10 text-zinc-700 cursor-not-allowed">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
                        </span>
                    @else
                        <button wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" class="flex items-center justify-center w-10 h-10 text-zinc-400 hover:text-white hover:bg-white/10 rounded-xl transition-all duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"/></svg>
                        </button>
                    @endif
                </li>

                {{-- Pagination Elements --}}
                <div class="flex items-center gap-1">
                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <li><span class="w-10 h-10 flex items-center justify-center text-zinc-600 font-bold">{{ $element }}</span></li>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                <li>
                                    @if ($page == $paginator->currentPage())
                                        <span class="flex items-center justify-center w-10 h-10 text-sm font-black bg-white text-zinc-950 rounded-xl shadow-[0_0_20px_rgba(255,255,255,0.15)] transform scale-110">
                                            {{ $page }}
                                        </span>
                                    @else
                                        <button wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" class="flex items-center justify-center w-10 h-10 text-sm font-semibold text-zinc-400 hover:text-white hover:bg-white/5 rounded-xl transition-all duration-200">
                                            {{ $page }}
                                        </button>
                                    @endif
                                </li>
                            @endforeach
                        @endif
                    @endforeach
                </div>

                {{-- Next Page Link --}}
                <li>
                    @if ($paginator->hasMorePages())
                        <button wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" class="flex items-center justify-center w-10 h-10 text-zinc-400 hover:text-white hover:bg-white/10 rounded-xl transition-all duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
                        </button>
                    @else
                        <span class="flex items-center justify-center w-10 h-10 text-zinc-700 cursor-not-allowed">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7"/></svg>
                        </span>
                    @endif
                </li>
            </ul>
        </nav>
    </div>
@endif
