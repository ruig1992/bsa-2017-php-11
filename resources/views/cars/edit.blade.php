@extends('layouts.app')

@section('title', 'Edit the car')
@section('meta-description', 'Edit the car - ' . $car['model'])

@section('content')
  <section>
    @component('components.page-header')
      @slot('header') Edit the car #{{ $car['id'] }} @endslot
      @slot('icon') fa-pencil @endslot
    @endcomponent

    <div class="container">
      @include('cars.partials.car-form', [
        'action' => route('cars.update', ['id' => $car['id']]),
        'method' => 'PUT',
      ])
    </div>
</section>
@endsection
