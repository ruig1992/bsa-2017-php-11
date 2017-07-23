@extends('layouts.app')

@section('title', 'Login')
@section('meta-description', 'Login page')

@section('content')
  <section>
    @component('components.page-header')
      @slot('header') Login @endslot
      @slot('icon') fa-sign-in @endslot
    @endcomponent

    <div class="container">
      <form method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}

        <div class="form-group row no-gutters">

          <div class="col col-lg-4{{ $errors->has('email') ? ' has-danger' : '' }}">
            <div class="input-group">
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

          <div class="col col-lg-4 mx-2{{ $errors->has('password') ? ' has-danger' : '' }}">
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-key" aria-hidden="true"></i>
              </div>
              <input id="password" type="password" class="form-control{{ $errors->has('password') ?
                ' form-control-danger' : '' }}" name="password" placeholder="Password">
            </div>

            @if ($errors->has('password'))
              <div class="form-control-feedback">{{ $errors->first('password') }}</div>
            @endif
          </div>
        </div>

        <div class="form-group row align-items-center mt-4">
          <div class="col-4 text-right">
            <label class="form-check-label noselect">
              <input class="form-check-input" type="checkbox"
                name="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
            </label>
          </div>

          <div class="col">
            <button type="submit" class="btn btn-primary">
              <i class="fa fa-sign-in fa-lg mr-1" aria-hidden="true"></i> Login</button>

            <a class="btn btn-link" href="{{ route('password.request') }}">
              Forgot Your Password?</a>
          </div>
        </div>

        @include('auth.partials.social-form')

      </form>
    </div>
  </section>

@endsection
