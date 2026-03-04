@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}"
         class="flex items-center justify-center mt-6">

        <span class="inline-flex shadow-sm rounded-md">

            {{-- Previous Page Link --}}
            @if (!$paginator->onFirstPage())
                <a href="{{ $paginator->previousPageUrl() }}"
                   rel="prev"
                   class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-l-md hover:bg-gray-100 transition">
                    ‹
                </a>
            @endif


            {{-- Pagination Elements --}}
            @foreach ($elements as $element)

                {{-- Three Dots Separator --}}
                @if (is_string($element))
                    <span class="inline-flex items-center px-4 py-2 text-sm text-gray-500 bg-white border border-gray-300">
                        {{ $element }}
                    </span>
                @endif


                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)

                        {{-- Current Page --}}
                        @if ($page == $paginator->currentPage())
                            <span class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-green-500 border border-green-500">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                               class="inline-flex items-center px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 transition">
                                {{ $page }}
                            </a>
                        @endif

                    @endforeach
                @endif

            @endforeach


            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   rel="next"
                   class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-r-md hover:bg-gray-100 transition">
                    ›
                </a>
            @endif

        </span>
    </nav>
@endif