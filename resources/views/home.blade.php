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
                    <li><a href="3dprinting.html">Backend</a></li>|
                    <li><a href="materials.html">Frontend</a></li>|
                    <li><a href="printing.html">Design</a></li>|
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
            <div class="col-md-7 content-left">
                <h5 class="head">recent</h5>

                <div class="article" ng-repeat="blog in blogs">
                    <h6><%blog.category.name%> </h6>
                    <a target="_self" class="title" href="/blog/<%blog.id%>">
                        <%blog.title%>
                    </a>
                    <img src="images/blog/a1.jpg" alt="" />
                    <p><%blog.description%></p>
                    <div class="pull-right"><%blog.views%> <span class="glyphicon glyphicon-eye-open"> </span></div>
                </div>

            </div>
            <div class="col-md-5 content-right">
                <h5 class="head">Popular</h5>
                <div class="content-right-top" ng-repeat="sort in sorted">
                    <a target="_self" href="/blog/<%sort.id%>">
                        <div class="editor text-center">
                            <h3><%sort.title%></h3>
                            <p><%sort.description%></p>
                            <label><%sort.created_at%> and:  </label><label><%sort.views%></label>
                            <span></span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

@endsection
