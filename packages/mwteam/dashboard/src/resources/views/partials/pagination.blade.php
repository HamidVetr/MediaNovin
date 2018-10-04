@if ($paginator->hasPages())
    <div class="ht-80 d-flex align-items-center justify-content-center mg-t-20 rtl">
        <ul class="pagination pagination-circle mg-b-0">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item hidden-xs-down disabled">
                    <a class="page-link" href="#" aria-label="First"><i class="fa fa-angle-right"></i></a>
                </li>
            @else
                <li class="page-item hidden-xs-down">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="First"><i class="fa fa-angle-right"></i></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active"><a class="page-link" href="#">{{ $page }}</a></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item hidden-xs-down">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Last"><i class="fa fa-angle-left"></i></a>
                </li>
            @else
                <li class="page-item hidden-xs-down disabled">
                    <a class="page-link" href="#" aria-label="Last"><i class="fa fa-angle-left"></i></a>
                </li>
            @endif
        </ul>
    </div>
@endif
