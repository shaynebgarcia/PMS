<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laravel</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
    {{-- CSS Stylesheets --}}
    @include('layouts.css')
      {{-- CSS Plugin Stylesheets --}}
      @yield('css-plugin')
  </head>

  <body class="hold-transition">
    {{-- Pre-loader --}}
    <div class="loader-bg">
      <div class="loader-bar"></div>
    </div>

    <div id="pcoded" class="pcoded">
      <div class="pcoded-overlay-box"></div>
      <div class="pcoded-container navbar-wrapper">
        {{-- Main Top Header --}}
        @include('includes.header')
        <div class="pcoded-main-container">
          <div class="pcoded-wrapper">
            {{-- Main Sidebar --}}
            @include('includes.sidebar')
            <div class="pcoded-content">
              @include('includes.breadcrumb')
              <div class="pcoded-inner-content">
                <div class="main-body">
                  <div class="page-wrapper">
                    <div class="page-body">
                      {{-- Content --}}
                      @yield('content')
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>

      </div>
    </div>
    {{-- JS Scripts --}}
    @include('layouts.js')
      {{-- JS Plugin Scripts --}}
      @yield('modals')
      @yield('js-plugin')
  </body>
</html>