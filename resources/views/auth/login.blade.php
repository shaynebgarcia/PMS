@extends('layouts.admindek-auth')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <form class="md-float-material form-material" method="POST" action="{{ route('login') }}">
                    @CSRF
                    <div class="text-center">
                        {{-- <i class="feather icon-home text-white" style="font-size: xx-large;" ></i> --}}
                        <img src="{{ asset('admindek/files/assets/images/logo.png') }}" alt="logo.png" style="padding: 2rem 0;">
                    </div>
                    <div class="auth-box card">
                        <div class="card-block">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <h3 class="text-center txt-primary">Sign In</h3>
                                </div>
                            </div>
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    @php
                                        print_r(Session::all());
                                    @endphp
                                 </div>
                             </div>

                            <div class="form-group form-primary">
                                <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <span class="form-bar"></span>
                                <label class="float-label">Email Address/Username</label>
                            </div>
                            <div class="form-group form-primary">
                                <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
                                <span class="form-bar"></span>
                                <label class="float-label">Password</label>
                            </div>

                            <div class="form-group form-primary">
                                <select name="role" id="role" class="form-control" required="">
                                    <option value="" disabled selected>Select Access</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group form-primary">
                                <select name="selected_property_id" id="property" class="form-control" required="">
                                    <option value="" disabled selected>Select Property</option>
                                    @foreach($properties as $property)
                                        <option value="{{ $property->id }}">{{ $property->name }}</option>
                                    @endforeach
                                    {{-- <option value="">Tenant</option> --}}
                                </select>
                            </div>
                            {{-- <div class="row m-t-25 text-left">
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
                            </div> --}}
                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-inverse btn-md btn-block waves-effect text-center m-b-10">LOGIN</button>
                                </div>
                            </div>
                            {{-- <p class="text-inverse text-left">Don't have an account?<a href="auth-sign-up-social.html"> <b>Register here </b></a>for free!</p> --}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@include('sweet::alert')

@section('js-plugin')
    <script type="text/javascript">
      $(document).ready(function(){

        swal("Good job!", "You clicked the button!", "success", {
          button: "Aww yiss!",
        });

        $("#property").hide();

        $("#role").on('change',function () {
            if ($(this).val() == 'Admin' || 'Manager') {
                $("#property").fadeToggle();
            }
        });

      });
    </script>
@endsection