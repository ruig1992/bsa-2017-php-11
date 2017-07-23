@extends('layouts.app')

@section('title', 'Reset Password')
@section('meta-description', 'Reset Password page')

@section('content')
<section>
  @component('components.page-header')
    @slot('header') Reset Password @endslot
    @slot('icon') fa-share @endslot
  @endcomponent

  <div class="container">
    @if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form class="form-inline" method="POST" action="{{ route('password.email') }}">
      {{ csrf_field() }}

      <div class="{{ $errors->has('email') ? ' has-danger' : '' }}">
        <label class="sr-only" for="email">E-Mail</label>
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
          <div class="input-group-addon">
            <i class="fa fa-envelope-o" aria-hidden="true"></i>
          </div>
          <input id="email" type="email" class="form-control{{ $errors->has('email') ?
            ' form-control-danger' : '' }}" name="email"
            value="{{ old('email') }}"
            placeholder="E-Mail" autofocus>
        </div>

        @if ($errors->has('email'))
          <div class="form-control-feedback">{{ $errors->first('email') }}</div>
        @endif
      </div>

      <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
    </form>
  </div>

</section>
@endsection
