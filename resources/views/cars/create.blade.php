@extends('layouts.app')

@section('title', 'Add a new car')
@section('meta-description', 'Add a new car in the list')

@section('content')
  <section>
    @component('components.page-header')
      @slot('header') Add a new car @endslot
      @slot('icon') fa-plus @endslot
    @endcomponent

    <div class="container">
      @include('cars.partials.car-form', ['action' => route('cars.store')])
    </div>
  </section>
@endsection
