<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title>BWS | KTA Online</title>
    <style>
        @font-face {
            font-family: 'fontes';
            src: url('http://127.0.0.1:777/fonts/Quicksand-Regular.ttf') format("truetype");
            font-weight: normal;
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

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
</head>
<body>
    <br>
    <div id="app">
        <img src="{{URL::asset('assets/img/bws.png')}}" class=" m-0 mb-4" alt="logo" width="120">
            <center>
                <h6><b><u>Resume Permohonan KTA</u></b></h6>
            </center>
        <main class="py-4">
            @yield('content')
            
        </main>
    </div>
    {{-- @include('layout.scripts') --}}
</body>

</html>
