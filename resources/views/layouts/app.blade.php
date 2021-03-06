<!DOCTYPE html>
<html>
<head>
    <title>@yield('pageTitle')</title>
    <link href="/css/app.css" rel='stylesheet' type='text/css' />
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
        <div class="navigation header_right">

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        @lang('messages.language') <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu layout_menu" role="menu">
                        <li><a href="/change-locale/ua">ua</a></li>
                        <li><a href="/change-locale/en">en</a></li>
                        <li><a href="/change-locale/ru">ru</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav">
                <li>
                    <div class="form-style-8">
                        {!! Form::open(array('url'=>route("search"),'method'=>'GET')) !!}
                            {!! Form::text('q', '', ['placeholder'=>__('messages.search'), 'required'=>'true']) !!}
                        {!! Form::close() !!}
                    </div>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">@lang('messages.login')</a></li>
                    <li><a href="{{ url('/register') }}">@lang('messages.register')</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu layout_menu" role="menu">
                            <li><a href="{{ url('/article/write') }}">@lang('messages.write an article')</a></li>
                            <li><a href="{{ url('/profile') }}">@lang('messages.my profile')</a></li>
                            <li><a href="{{ url('/logout') }}">@lang('messages.logout')</a></li>
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
                <p class="text-center">Face2WEB © 2017  @lang('messages.all rights reserved')</p>
            </div>
        </div>
    </div>
</div>
<script src="/js/app.js"></script>
</body>
</html>




