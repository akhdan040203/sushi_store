@if ($paginator->hasPages())
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 py-6 px-4 bg-zinc-900/50 border border-white/5 rounded-2xl">
        {{-- Summary (Left) --}}
        <div class="text-sm text-zinc-400">
            Showing 
            <span class="font-medium text-white">{{ $paginator->firstItem() ?? 0 }}</span> 
            to 
            <span class="font-medium text-white">{{ $paginator->lastItem() ?? 0 }}</span> 
            of 
            <span class="font-medium text-white">{{ $paginator->total() }}</span> 
            results
        </div>

        {{-- Navigation (Right) --}}
        <nav role="navigation" aria-label="Pagination Navigation">
            <ul class="flex items-center gap-1.5 p-1 bg-black/20 backdrop-blur-sm border border-white/10 rounded-xl">
                {{-- Previous Page Link --}}
                <li>
                    @if ($paginator->onFirstPage())
                        <span class="flex items-center justify-center w-9 h-9 text-zinc-600 cursor-not-allowed">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" class="flex items-center justify-center w-9 h-9 text-zinc-400 hover:text-white hover:bg-white/10 rounded-lg transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                        </a>
                    @endif
                </li>

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li><span class="w-9 h-9 flex items-center justify-center text-zinc-600">{{ $element }}</span></li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            <li>
                                @if ($page == $paginator->currentPage())
                                    <span class="flex items-center justify-center w-9 h-9 text-sm font-bold bg-white text-black rounded-lg shadow-lg shadow-white/10">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="flex items-center justify-center w-9 h-9 text-sm font-medium text-zinc-400 hover:text-white hover:bg-white/5 rounded-lg transition-colors">
                                        {{ $page }}
                                    </a>
                                @endif
                            </li>
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                <li>
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" class="flex items-center justify-center w-9 h-9 text-zinc-400 hover:text-white hover:bg-white/10 rounded-lg transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    @else
                        <span class="flex items-center justify-center w-9 h-9 text-zinc-600 cursor-not-allowed">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </span>
                    @endif
                </li>
            </ul>
        </nav>
    </div>
@endif
