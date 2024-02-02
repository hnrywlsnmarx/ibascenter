<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title>I.B.A.S Center</title>
    <style>
        @font-face {
            font-family: 'fontes';
            src: url('http://localhost:777/fonts/Quicksand-Medium.ttf') format("truetype");
            font-weight: 100;
            font-style: normal;
            font-variant: normal;
        }
        body {
            font-family: 'fontes' !important;
            font-size: smaller;
        }
    </style>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="icon" href="{{URL::asset('assets/img/favicon.ico')}}" type="image/x-icon"/>
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    {{-- <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet"> --}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:ital,wght@0,300;1,300&display=swap" rel="stylesheet"> --}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Fuzzy+Bubbles" rel="stylesheet"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        
        {{-- @include('layouts.horizontalmenu.main-header')
        @include('layouts.horizontalmenu.horizontal-main') --}}

        <nav class="navbar navbar-expand-md navbar-light" style="background-color: #33c278;">
        {{-- <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color:#0313D8;"> --}}
            <div class="container">
                <a class="navbar-brand" href="#" style=" color: white;">
                    {{-- BWS | KTA Online --}}
                    {{-- <img src="{{URL::asset('assets/img/logo.png')}}" alt="logo" width="105"> --}}
                    I.B.A.S Center | Pasti Menang!
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                {{-- <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Selamat datang, {{ Auth::user()->name }}
                                </a> --}}

                                {{-- <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown"> --}}
                                    <a class="dropdown-item" href="{{ route('logouts') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" style="color: rgb(249, 249, 249);">
                                        Signout
                                    </a>

                                    <form id="logout-form" action="{{ route('logouts') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                {{-- </div> --}}
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
            @yield('content')
    </div>
    @include('layouts.scripts')
    @include('layouts.footer')
</body>
@stack('scripts')
</html>
