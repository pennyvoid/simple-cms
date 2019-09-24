@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-center" >
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" style="display:inline" >
                    <span class="page-link">@lang('pagination.previous')</span>
                </li>
            @else
                <li class="page-item" style="display:inline-block">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item float-right" style="display:inline-block">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
                </li>
            @else
                <li class="page-item disabled float-right" aria-disabled="true" style="display:inline-block">
                    <span class="page-link">@lang('pagination.next')</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
