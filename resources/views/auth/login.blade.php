@extends('layouts.app')

@section('content')
    <body class="bg-dark">
        <div class="sufee-login d-flex align-content-center flex-wrap">
            <div class="container">
                <div class="login-content">
                    <div class="login-logo">
                        <a href="{{ route('home') }}">
                            <img class="align-content" src="{{ asset('image/logo_skinny.png') }}" alt="">
                        </a>
                    </div>
                    <div class="login-form">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label>{{ __('E-Mail Address') }}</label>
                                <input type="email" id="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"placeholder="Email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>{{ __('Password') }}</label>
                                <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                </label>
                                <label class="pull-right">
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </label>
                            </div>

                            <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">
                                {{ __('Login') }}
                            </button>
                            <!--
                                <div class="register-link m-t-15 text-center">
                                    @if (Route::has('register'))
                                        <p>Don't have account ?
                                            <a href="{{ route('register') }}">
                                                {{ __('Register') }}
                                            </a>
                                        </p>
                                    @endif
                                </div>
                            -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
