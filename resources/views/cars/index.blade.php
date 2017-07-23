@extends('layouts.app')

@section('title', 'Cars list')
@section('meta-description', 'View a list of all available cars')

@section('content')
  <section>
    @component('components.page-header')
      @slot('header') Cars List @endslot
      @slot('icon') fa-list-alt @endslot
    @endcomponent

    @if (count($cars) === 0)
      @component('components.alert')
        @slot('type') warning @endslot
        No cars... Unfortunately, you will have to walk. :-)
      @endcomponent
    @else

      <div class="row cars-cards">
        @foreach ($cars as $car)
          <div class="col-12 col-md-6 col-lg-4 p-3">
            @include('cars.partials.car-item', ['vMode' => 'index'])
          </div>
        @endforeach
      </div>

      @if ($cars->simple)
        {{ $cars->links('vendor.pagination.simple') }}
      @else
        {{ $cars->links('vendor.pagination.full') }}
      @endif
    @endif

  </section>
@endsection
