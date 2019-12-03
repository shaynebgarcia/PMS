<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="colorlib.com">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Occupant Form</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('auth-wizard/fonts/material-icon/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('laravel-admindek/bower_components/jquery.steps/css/jquery.steps.css') }}">
    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('auth-wizard/css/style.css') }}">
</head>
<body>

    <div class="main">
      @yield('content')
    </div>

    <!-- JS -->
    <script src="{{ asset('auth-wizard/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('auth-wizard/vendor/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('auth-wizard/vendor/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script src="{{ asset('auth-wizard/vendor/jquery-steps/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('auth-wizard/js/main.js') }}"></script>
</body>
</html>