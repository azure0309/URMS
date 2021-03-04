<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'URMS') }}</title>
    <link rel="icon" type="image/gif/png" href="{{ asset('images/chart.png') }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <div class="row">
              <div class="col-sm-3">
                <img src="{{ asset('images/logo.png') }}" class="navbar-brand img-rounded">
              </div>
              <div class="col-sm-9">
                <b class="navbar-brand text-secondary">Roaming Monitoring System</b>
              </div>
          </div>
        </div>
    </nav>

    @yield('content')
</div>
<!-- Footer -->
<footer class="page-footer font-small blue">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">
    <p>&copy 2021 NSS team at Unitel. <br>
        All Right Reserved. Version 4.3.0</p>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
