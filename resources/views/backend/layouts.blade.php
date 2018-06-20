<!doctype html>
<html lang="en">
<head>
    <script>
        if (typeof document.documentMode !== 'undefined' && document.documentMode <= 8) {
            alert('Sorry, IE ' + document.documentMode + ' is not supported for now, please use Chrome Firefox or IE 10+ to continue.');
        }
    </script>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Intellisn</title>
    {{-- TODO Title Config From DB --}}
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600%7CRaleway:300,400,500,600,700%7CLato:300,400,400italic,600,700" rel="stylesheet" type="text/css" />
    <link href="https://cdn.bootcss.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet">

    {{--@if(config('app.env') !== 'production' || app('request') -> header('host') === config('domains.china'))--}}
    {{--<link href="https://cdn.bootcss.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet">--}}
    {{--@else--}}
    {{--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">--}}
    {{--@endif--}}
    <link rel="stylesheet" href="{{ CDN_SERVER }}/plugins/fontawesome/css/fontawesome-all.min.css">
    <link href="{{ CDN_SERVER }}/css/smarty/essentials.css" rel="stylesheet" type="text/css" />
    <link href="{{ CDN_SERVER }}/css/smarty/layout.css?v={{ config('app.static.version') }}" rel="stylesheet" type="text/css" id="color_scheme" />
    <link href="{{ CDN_SERVER }}/css/smarty/header.css" rel="stylesheet" type="text/css" />
    <link href="{{ CDN_SERVER }}/css/smarty/blue.css" rel="stylesheet" type="text/css" id="color_scheme" />
    <link rel="stylesheet" href="{{ CDN_SERVER }}/css/style.css?v={{ config('app.static.version') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="smoothscroll enable-animation">

<div class="warp">
    <div class="main">
        @yield('main')
    </div>
    <footer id="footer">
        @include('layouts.footer')
    </footer>
</div>

<!-- SCROLL TO TOP -->
<a href="#" id="toTop"></a>

<!-- PRELOADER -->
<div id="preloader">
    <div class="inner">
        <span class="loader"></span>
    </div>
</div>
<!-- /PRELOADER -->

<div class="self-placeholder hide">
    <div class="inner">
        <span class="loader"></span>
    </div>
</div>
<script src="https://cdn.bootcss.com/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
{{--@if(config('app.env') !== 'production' || app('request') -> header('host') === config('domains.china'))--}}
{{----}}
{{--@else--}}
{{--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>--}}
{{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>--}}
{{--@endif--}}
<script src="https://cdn.bootcss.com/Base64/1.0.1/base64.min.js"></script>
<script src="{{ CDN_SERVER }}/plugins/jquery.base64/jquery.base64.js"></script>
<script src="{{ CDN_SERVER }}/plugins/jquery.cookie/jquery.cookie.js"></script>
<!-- JAVASCRIPT FILES -->
<script>let plugin_path = '{{ CDN_SERVER }}/plugins/';</script>
<script src="{{ CDN_SERVER }}/js/smarty/scripts.js?v={{ config('app.static.version') }}"></script>
<script src="{{ CDN_SERVER }}/js/functions.js?v={{ config('app.static.version') }}"></script>
</body>
</html>