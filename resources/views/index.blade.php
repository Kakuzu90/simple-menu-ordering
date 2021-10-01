<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        Simple Online Menu Ordering Application
    </title>

    <link rel="shortcut icon" href="{{ asset('image/logo.jpg') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('lib/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/cassie.css') }}">

    <link rel="stylesheet" href="{{ asset('lib/animate.css/animate.min.css') }}">
</head>
<body style="background-color: #f3f3f3;">

    <div id="app">

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Simple Online Menu Ordering Applications
                </a>
            </div>
        </nav>

        <main-component />

    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

