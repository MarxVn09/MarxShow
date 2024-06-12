@if ($paginator->hasPages())
    <div class="product__pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="disabled" href="#">&laquo;</a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}">&laquo;</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span>{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="active" href="#">{{ $page }}</a>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}">&raquo;</a>
        @else
            <a class="disabled" href="#">&raquo;</a>
        @endif
    </div>
@endif
