<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Missfashion Shop | Welcome</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/front/css/style.min.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="{{ URL::asset('/front/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('/front/js/slick.min.js') }}"></script>
    <script src="{{ URL::asset('/front/js/main.js') }}"></script>
    @php
        if (env('INCLUDE_REV_SLIDER')){
            include_once __DIR__ . "../../../../public/revslider/embed.php";
            RevSliderEmbedder::headIncludes(false);
        }
    @endphp
</head>
<body>

@include('front.header')

@yield('content')

@include('front.page-contents')

@include('front.footer')
</body>
</html>
