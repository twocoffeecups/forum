<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Forum') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
          integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte/css/adminlte.min.css') }}">

</head>
<body class="hold-transition">

    @yield('content')

<!-- jQuery -->
<script src="{{ asset('assets/adminlte/js/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/adminlte/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/adminlte/js/adminlte.min.js') }}"></script>
</body>
</html>
