<!DOCTYPE html>
<html>
<head>
    <title>@yield('pageTitle')</title>
    <link href="/css/app.css" rel='stylesheet' type='text/css' />
    {{--<link href="/css/style.css" rel="stylesheet" type="text/css" media="all" />--}}
    {{--<script src="/js/js_modules/jquery.min.js"></script>--}}
    {{--<script src="/js/js_modules/underscore-min.js"></script>--}}

    <link rel="icon" type="image/png" href="/images/site/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="Blog, WEB, WEB-Development, Frontend, Backend, Design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
</head>
<body>
<!-- header-section-starts -->
<div class="header" id="top">
    <div class="container">
        <div class="logo">
           <span><a href="{{ url('/') }}">Face2WEB</a></span>
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
                <p class="text-center">Face2WEB © 2017 All rights reserved </p>
            </div>
        </div>
    </div>
</div>


        <!-- JavaScripts -->
{{--<script src="/bootstrap/js/bootstrap.min.js"></script>--}}
{{--<script src="/js/js_modules/angular.min.js"></script>--}}
{{--<script src="/js/js_modules/angular-ui-router.min.js"></script>--}}
{{--<script src="/js/js_modules/ui-bootstrap-tpls-1.2.5.min.js"></script>--}}
{{--<script src="/js/angular/main.module.js"></script>--}}
{{--<script src="/js/angular/main.config.js"></script>--}}
{{--<script src="/js/angular/main.controller.js"></script>--}}

<script src="/js/app.js"></script>
</body>
</html>




