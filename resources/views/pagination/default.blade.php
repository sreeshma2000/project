@if($paginator->hasPages())
<nav class="page-section">
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if($paginator->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link" href="javascript:void(0)" aria-label="Previous" style="color:#6c757d;">
                    <span aria-hidden="true">
                        <i class="fas fa-chevron-left"></i>
                    </span>
                </a>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">
                        <i class="fas fa-chevron-left"></i>
                    </span>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if(is_string($element))
                <li class="page-item disabled">
                    <a class="page-link" href="javascript:void(0)">{{ $element }}</a>
                </li>
            @endif

            {{-- Array Of Links --}}
            @if(is_array($element))
                @foreach($element as $page => $url)
                    @if($page == $paginator->currentPage())
                        <li class="page-item active">
                            <a class="page-link" href="javascript:void(0)">{{ $page }}</a>
                        </li>
                    @elseif($page <= 2) {{-- Limit to first 2 pages --}}
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if($paginator->hasMorePages() && $paginator->currentPage() < 2)
            <li class="page-item">
                <a href="{{ $paginator->nextPageUrl() }}" class="page-link" aria-label="Next">
                    <span aria-hidden="true">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <a href="javascript:void(0)" class="page-link" aria-label="Next">
                    <span aria-hidden="true">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                </a>
            </li>
        @endif
    </ul>
</nav>
@endif


