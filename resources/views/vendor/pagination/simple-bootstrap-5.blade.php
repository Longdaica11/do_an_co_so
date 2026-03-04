@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{!! __('Pagination Navigation') !!}">
        <ul class="pagination justify-content-center">

            {{-- Previous Page Link --}}
            @if (!$paginator->onFirstPage())
                <li class="page-item">
                    <a class="page-link" 
                       href="{{ $paginator->previousPageUrl() }}" 
                       rel="prev">
                        &laquo; Previous
                    </a>
                </li>
            @endif


            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" 
                       href="{{ $paginator->nextPageUrl() }}" 
                       rel="next">
                        Next &raquo;
                    </a>
                </li>
            @endif

        </ul>
    </nav>
@endif