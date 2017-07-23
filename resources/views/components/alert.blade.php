<div class="alert alert-{{ $type or 'danger' }}" role="alert">
  <i class="fa fa-frown-o fa-3x mr-3 align-middle" aria-hidden="true"></i>

  @if ($errorCode ?? 0)
    <b>Error {{ $errorCode }}
      <i class="fa fa-angle-right ml-1 mr-2" aria-hidden="true"></i></b>
  @endif

  {{ $slot }}
</div>
