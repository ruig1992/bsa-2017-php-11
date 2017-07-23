<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Car Hire Deals') }}</title>
    <meta name="description" content="@yield('meta-description')">

    <!-- Styles -->
    <!-- Bootstrap 4.0.0 CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ"
      crossorigin="anonymous">

    <style>.noselect{-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.btn:focus{background-color:transparent}.btn-primary:focus{color:#0275d8}a.btn-success:focus{color:#5cb85c}a.btn-danger:focus{color:#d9534f}.main-wrapper{padding-bottom:5rem}.navbar-brand{font-weight:500}.cars-cards{margin-top:-1rem}.form-control-label,.car-field{font-weight:600}.form-control-feedback{font-size:.9em}
    </style>
  </head>

  <body>
    <div id="app" class="main-wrapper">
      {{-- <nav class="navbar navbar-default navbar-static-top"> --}}
      <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse">
        <!-- Collapsed Hamburger -->
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Branding Image -->
        <a href="{{ route('app.index') }}" class="navbar-brand mb-0">
          {{ config('app.name', 'Car Hire Deals') }}</a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">
            @if (!Auth::guest())
              <li class="nav-item {{ isActiveRoute('cars.index') }}">
                <a class="nav-link" href="{{ route('cars.index') }}">Cars list</a>
              </li>

              @can('cars.create')
              <li class="nav-item {{ isActiveRoute('cars.create') }}">
                <a class="nav-link" href="{{ route('cars.create') }}">Add</a>
              </li>
              @endcan
            @endif
          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links -->
            @if (Auth::guest())
            <li class="nav-item {{ isActiveRoute('login') }}">
              <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>

            <li class="nav-item {{ isActiveRoute('register') }}">
              <a class="nav-link" href="{{ route('register') }}">Register</a>
            </li>

            @else
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->full_name }}
                {{-- <span class="caret"></span> --}}
              </a>

              <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <li>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>

                  <form id="logout-form" action="{{ route('logout') }}"
                    method="POST" style="display:none">{{ csrf_field() }}</form>
                </li>
              </ul>
            </li>
            @endif
          </ul>
        </div>
      </nav>

      <div class="container p-4">
        @yield('content')
      </div>
    </div>

    <!-- Font Awesome 4.7.0 from BootstrapCDN -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
      rel="stylesheet"
      integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
      crossorigin="anonymous">

    <!-- Scripts -->
    <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"
      integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n"
      crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
      integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
      crossorigin="anonymous"></script>
  </body>
</html>
