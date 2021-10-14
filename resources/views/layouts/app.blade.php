<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'For Math') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
    <main class="content">
    @include('layouts.navbar')
    <div class="flash-message">
        @if ($errors->any())
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <ul>
                @foreach ($errors->all() as $error)
                   <ul>{{ $error }}</ul>
                @endforeach
                </ul>
            </div>
        @endif
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
        </div>
        <div class="d-flex" id="wrapper">
            @include('layouts.sidebar')
        <div class="container">
            <div class="container p-2">
            @include('layouts.search')
            </div>
                @yield('content')
                @yield('exercise')
                @yield('my-exercises')
                @yield('edit-exercise')
                @yield('my-exercises')
                @yield('404')
                @yield('solve-exercise')
                </div>
            </div>
{{--            @include('layouts.footer')--}}
            </main>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('js/sidebar.js') }}" rel="stylesheet"></script>
</body>
</html>
