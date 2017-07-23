@if ($paginator->hasPages())
  <ul class="pagination justify-content-center">
    {{-- Previous Page Link --}}
    @if (!$paginator->onFirstPage())
      <li class="page-item">
        <a class="page-link" rel="prev"
          href="@if ($paginator->currentPage() - 1 === 1) {{ request()->url() }}
          @else {{ $paginator->previousPageUrl() }}
          @endif">&laquo;</a>
      </li>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
      {{-- "Three Dots" Separator --}}
      @if (is_string($element))
        <li class="page-item disabled">
          <span class="page-link">{{ $element }}</span>
        </li>
      @endif

      {{-- Array Of Links --}}
      @if (is_array($element))
        @foreach ($element as $page => $url)
          @if ($page == $paginator->currentPage())
            <li class="page-item active">
              <span class="page-link">{{ $page }}</span>
            </li>
          @else
            <li class="page-item">
              <a class="page-link" href="@if ($page === 1)
                {{ request()->url() }} @else {{ $url }} @endif">{{ $page }}</a>
            </li>
          @endif
        @endforeach
      @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
      <li class="page-item">
        <a class="page-link" rel="next"
          href="{{ $paginator->nextPageUrl() }}">&raquo;</a>
      </li>
    @endif
  </ul>
@endif
