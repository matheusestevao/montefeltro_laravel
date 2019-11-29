@extends('layouts.app')

@section('content')
    <body class="bg-dark">
        <div class="sufee-login d-flex align-content-center flex-wrap">
            <div class="container">
                <div class="login-content">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="login-logo">
                        <a href="{{ route('home') }}">
                            <img class="align-content" src="{{ asset('image/logo_skinny.png') }}" alt="">
                        </a>
                    </div>
                    <div class="login-form">
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group">
                                <label>{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                                <button type="submit" class="btn btn-primary btn-flat m-b-15">{{ __('Send Password Reset Link') }}</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
