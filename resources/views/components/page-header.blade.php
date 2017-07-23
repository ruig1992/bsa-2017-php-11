<header class="mb-5">
  <h1 class="h3">
    @isset ($icon)
      <i class="fa mr-2 {{ $icon }}" aria-hidden="true"></i>
    @endisset
    {{ $header or 'Header' }}
  </h1>

  {{ $slot }}
</header>
