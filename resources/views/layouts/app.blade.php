<!DOCTYPE html>
<html>
<head>
    <title>@yield('pageTitle')</title>
    <link href="/css/bootstrap.css" rel='stylesheet' type='text/css' /><link href="/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>

    <link rel="icon" type="image/png" href="/images/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Konstructs Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
</head>
<body>
<!-- header-section-starts -->
<div class="header">
    <div class="container">
        <div class="logo">
           <span>Face2WEB</span></h1>
        </div>
        <div class="navigation">

            <ul class="nav navbar-nav">
                <li><a class="active" href="{{ url('/') }}">Home</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu layout_menu" role="menu">
                            <li><a href="{{ url('/create') }}">Write an article</a></li>
                            <li><a href="{{ url('/profile') }}">My Profile</a></li>
                            <li><a href="{{ url('/logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
@yield('content')
<div class="clear"></div>
<div class="footer navbar-fixed-bottom">
    <div class="footer-bottom">
        <div class="container">
            <div class="copyrights">
                <p>Konstructs © 2015 All rights reserved | Template by  <a href="http://w3layouts.com">  W3layouts</a></p>
            </div>
        </div>
    </div>
</div>


        <!-- JavaScripts -->
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.js"></script>
<script src="/angular_modules/angular-ui-router/release/angular-ui-router.min.js"></script>
<script src="/angular_modules/ui-bootstrap-tpls-1.2.5.min.js"></script>
<script src="/js/angular/main.module.js"></script>
<script src="/js/angular/main.config.js"></script>
<script src="/js/angular/main.controller.js"></script>

{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>




