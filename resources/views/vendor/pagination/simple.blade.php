@if ($paginator->hasPages())
  <ul class="pagination justify-content-center">
    {{-- Previous Page Link --}}
    @if (!$paginator->onFirstPage())
      <li class="page-item">
        <a class="page-link" rel="prev"
          href="@if ($paginator->currentPage() - 1 === 1) {{ request()->url() }}
          @else {{ $paginator->previousPageUrl() }}
          @endif">@lang('pagination.previous')</a>
      </li>
    @endif

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
      <li class="page-item">
        <a class="page-link" rel="next"
          href="{{ $paginator->nextPageUrl() }}">@lang('pagination.next')</a>
      </li>
    @endif
  </ul>
@endif
