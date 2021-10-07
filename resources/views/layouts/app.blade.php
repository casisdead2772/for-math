<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'For Math') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">

    <link href="https://getbootstrap.com/docs/5.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.0/examples/product/product.css" rel="stylesheet">
</head>
<body style="margin-bottom: 144px">
<main class="content">
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div>
    @include('layouts.navbar')
    <div class="d-flex" id="wrapper">
        @include('layouts.sidebar')
        <div class="container">
        @yield('content')
        @yield('exercise')
        @yield('my-exercises')
        @yield('edit-exercise')
        @yield('my-exercises')
        @yield('404')
        </div>
    </div>
</main>
@include('layouts.footer')
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{ asset('js/sidebar.js') }}" rel="stylesheet"></script>
</html>
