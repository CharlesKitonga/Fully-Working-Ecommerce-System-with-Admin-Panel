<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="{{ asset('css/frontend_css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/prettyPhoto.css')}}" rel="stylesheet">

    <link href="{{ asset('css/frontend_css/price-range.css')}}" rel="stylesheet">
    <link href="{{ asset('css/frontend_css/animate.css')}}" rel="stylesheet">
	<link href="{{ asset('css/frontend_css/main.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/frontend_css/easyzoom.css')}}">
	<link href="{{ asset('css/frontend_css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('css/frontend_css/ninja-slider.css')}}" rel="stylesheet" type="text/css" />
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{ asset('images/frontend_images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('images/frontend_images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('images/frontend_images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('images/frontend_images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/frontend_images/ico/apple-touch-icon-57-precomposed.png')}}">

    <style>
        body {font: normal 0.9em Arial;margin:0;}
        a {color:#1155CC;}
        ul li {padding: 10px 0;}
        header {display:block;padding:60px 0 10px;background-color:#ffffff;text-align:center;}
        header a {
            font-family: sans-serif;
            font-size: 24px;
            line-height: 24px;
            padding: 8px 13px 7px;
            color: #ffffff ;
            text-decoration:none;
            transition: color 0.7s;
        }
        header a.active {
            font-weight:bold;
            width: 24px;
            height: 24px;
            padding: 4px;
            text-align: center;
            display:inline-block;
            border-radius: 50%;
            background: #ffffff;
            color: #191919;
        }
    </style>
</head><!--/head-->

<body>
  @include('layouts.frontLayout.front_header')
	
	@yield('content')
	
	@include('layouts.frontLayout.front_footer')
	

    <script src="{{asset('js/frontend_js/ninja-slider.js')}}" type="text/javascript"></script>
    <script src="{{ asset('js/frontend_js/jquery.js')}}"></script>
	<script src="{{ asset('js/frontend_js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/frontend_js/easyzoom.js')}}"></script>
	<script src="{{ asset('js/frontend_js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{ asset('js/frontend_js/price-range.js')}}"></script>
    <script src="{{ asset('js/frontend_js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{ asset('js/frontend_js/main.js')}}"></script>
</body>
</html>