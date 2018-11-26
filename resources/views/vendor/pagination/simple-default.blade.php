@if ($paginator->hasPages())
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="disabled"><span class="glyphicon glyphicon-chevron-left"></span></a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
        @else
            <a class="disabled"><span class="glyphicon glyphicon-chevron-right"></span></a>
        @endif
@endif