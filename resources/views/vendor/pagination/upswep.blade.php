{{-- ============================================================
     UPSWEP CUSTOM PAGINATION VIEW
     resources/views/vendor/pagination/upswep.blade.php

     Used by: {{ $products->links('vendor.pagination.upswep') }}

     Matches the .up-pagination CSS already in grid.blade.php.
     Registered automatically by Laravel's view system — no extra
     service provider registration needed.
============================================================ --}}

@if ($paginator->hasPages())
    <nav aria-label="Pagination">
        <ul>
            {{-- Previous page button --}}
            @if ($paginator->onFirstPage())
                <li aria-disabled="true">
                    <span>&laquo;</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a>
                </li>
            @endif

            {{-- Page number buttons --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li><span>{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next page button --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a>
                </li>
            @else
                <li aria-disabled="true">
                    <span>&raquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif