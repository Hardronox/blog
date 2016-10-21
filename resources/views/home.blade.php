@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="header-bottom">
            <div class="type">
                <h5>Article Types</h5>
            </div>
            <span class="menu"></span>
            <div class="list-nav">
                <ul>
                    <li><a href="3dprinting.html">Programming</a></li>|
                    <li><a href="materials.html">Hardware</a></li>|
                    <li><a href="printing.html">Economics</a></li>|
                    <li><a href="filestoprint.html">Buiseness</a></li>|
                </ul>
                <!-- Left Side Of Navbar -->

            </div>
            <!-- script for menu -->
            <script>
                $( "span.menu" ).click(function() {
                    $( ".list-nav" ).slideToggle( "slow", function() {
                        // Animation complete.
                    });
                });
            </script>
            <!-- script for menu -->

            <div class="clearfix"></div>
        </div>
    </div>
    <div class="container" ng-app="main" ng-controller="main" ng-cloak>
        <div class="content" >
            {{--<ul ng-repeat="blog in blogs">--}}
                {{--<li> <%blog.title%></li>--}}
            {{--</ul>--}}
            <div class="col-md-7 content-left">
                <h5 class="head">recent</h5>

                <div class="article" ng-repeat="blog in blogs">
                    <h6><%blog.category.name%> </h6>
                    <a class="title" href="single.html">
                        <%blog.title%>
                    </a>
                    <a href="single.html"><img src="images/a1.jpg" alt="" /></a>
                    <p><%blog.description%></p>
                </div>

            </div>
            <div class="col-md-5 content-right">
                <h5 class="head">Popular</h5>
                <div class="content-right-top" ng-repeat="sort in sorted">
                    <a href="single.html">
                        <div class="editor text-center">
                            <h3><%sort.title%></h3>
                            <p><%sort.description%></p>
                            <label><%sort.created_at%></label>
                            <span></span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
@endsection
{{--@if ($abc=='bitch')--}}
{{--I love {{$abc}}es--}}
{{--@endif--}}
{{--@foreach($orders as $order)--}}
{{--{{$order}}--}}
{{--@endforeach--}}