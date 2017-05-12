<!DOCTYPE>
<html>

<head>
    <meta charset="utf-8"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="msapplication-tap-highlight" content="no"/>
    <meta name="viewport"
          content="user-scalable=no, initial-scale=1.0, maximum-scale=1, minimum-scale=1, width=device-width"/>

    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-grid.css')}}">

    <script src="{{asset('js/bootstrap.js')}}"></script>
</head>

<body>

<div class="container">
    <div class="header">
        @yield('header')
    </div>

    @yield('content')

</div>

</body>

</html>
