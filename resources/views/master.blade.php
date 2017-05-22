<!DOCTYPE>
<html>

<head>
    <meta charset="utf-8"/>
    {{--<meta name="format-detection" content="telephone=no"/>--}}
    {{--<meta name="msapplication-tap-highlight" content="no"/>--}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/mycss.css')}}">
    <link rel="stylesheet" href="{{asset('css/site.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-grid.css')}}">

    <script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/validate.js')}}"></script>
    {{--    <script type="text/javascript" src="{{asset('js/bootstrap.js')}}"></script>--}}
</head>

<body>

@yield('nav')

<div class="container">
    <div class="header">
        @yield('header')
    </div>

    @yield('content')

</div>

</body>

</html>
