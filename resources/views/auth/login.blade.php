@extends('layouts.admindek-auth')

@section('content')
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <form class="md-float-material form-material" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="text-center">
                                    <img src="{{ asset('admindek/files/assets/images/logo.png') }}" alt="logo.png" style="padding: 2rem 0;">
                                </div>
                                <div class="auth-box card">
                                    <div class="card-block">
                                        <div class="row m-b-20">
                                            <div class="col-md-12">
                                                <h3 class="text-center txt-primary">Sign In</h3>
                                            </div>
                                        </div>
                                        {{-- <div class="row m-b-20">
                                            <div class="col-md-6">
                                                <button class="btn btn-facebook m-b-20 btn-block"><i class="icofont icofont-social-facebook"></i>facebook</button>
                                            </div>
                                            <div class="col-md-6">
                                                <button class="btn btn-twitter m-b-20 btn-block"><i class="icofont icofont-social-twitter"></i>twitter</button>
                                            </div>
                                        </div> --}}
                                        {{-- <p class="text-muted text-center p-b-5">Sign In</p> --}}
                                        <div class="form-group form-primary">
                                            <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}" required autocomplete="email">
                                            <span class="form-bar"></span>
                                            <label class="float-label">Email Address/Username</label>
                                        </div>
                                        <div class="form-group form-primary">
                                            <input id="password" type="password" name="password" class="form-control" required autocomplete="current-password">
                                            <span class="form-bar"></span>
                                            <label class="float-label">Password</label>
                                        </div>
                                        <div class="row m-t-25 text-left">
                                            <div class="col-12">
                                                <div class="checkbox-fade fade-in-primary">
                                                    <label>
                                                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                        <span class="text-inverse">Remember me</span>
                                                    </label>
                                                </div>
                                                @if (Route::has('password.request'))
                                                    <div class="forgot-phone text-right float-right">
                                                        <a href="{{ route('password.request') }}" class="text-right f-w-600"> Forgot Password?</a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row m-t-30">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">LOGIN</button>
                                            </div>
                                        </div>
                                        {{-- <p class="text-inverse text-left">Don't have an account?<a href="auth-sign-up-social.html"> <b>Register here </b></a>for free!</p> --}}
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail/Username') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
