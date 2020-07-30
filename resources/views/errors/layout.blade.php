<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Siva | @section('title') Autenticacion @show</title>
    <link rel="shortcut icon" href="{{ asset('images/gotita.png') }}" type="image/x-icon">
    
     <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('fonts/material-icon/css/material-design-iconic-font.min.css') }}">
    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

</head>
<body>
    <div class="main">
        @yield('content')
    </div>
</body>
</html>
