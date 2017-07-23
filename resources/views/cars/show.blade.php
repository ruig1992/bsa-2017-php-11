@extends('layouts.app')

@section('title', $car['model'])
@section('meta-description', 'Full information about the car - ' . $car['model'])

@section('content')
  <article>
    @component('components.page-header')
      @slot('header') Car Info @endslot
      @slot('icon') fa-car @endslot
    @endcomponent

    @include('cars.partials.car-item', ['vMode' => 'show'])
  </article>

@endsection
