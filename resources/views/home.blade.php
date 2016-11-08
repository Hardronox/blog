@extends('layouts.app')

@section('content')
    <div ng-app="main" ng-controller="main" ng-cloak>
        <div class="container">
            <div class="header-bottom">
                <div class="type">
                    <h5>Article Types</h5>
                </div>
                <span class="menu"></span>
                <div class="list-nav">
                    <ul>
                        <li><a ng-click="loadData('Backend')">Backend</a></li>|
                        <li><a ng-click="loadData('Frontend')">Frontend</a></li>|
                        <li><a ng-click="loadData('Design')">Design</a></li>|
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

                    function explode()
                    {
                        $('#crap').css('display','block');
                    }
                    setTimeout(explode, 1000);
                </script>
                <!-- script for menu -->

                <div class="clearfix"></div>
            </div>
        </div>
        <div class="container" >
            <div class="content" >
                <div class="col-md-7 content-left">
                    <h5 class="head">recent</h5>

                    <div class="article" ng-repeat="blog in blogs">
                        <h6><%blog.category.name%> </h6>
                        <a target="_self" class="title" href="/blog/<%blog.id%>">
                            <%blog._source.title%>
                        </a>
                        <img src="images/blog/a1.jpg" alt="" />
                        <p><%blog._source.description%></p>
                        <div class="pull-right"><%blog._source.views%> <span class="glyphicon glyphicon-eye-open"> </span></div>
                    </div>

                </div>
                <div class="col-md-5 content-right">
                    <h5 class="head">Popular</h5>
                    <div class="content-right-top" ng-repeat="sort in sorted">
                        <a target="_self" href="/blog/<%sort.id%>">
                            <div class="editor text-center">
                                <h3><%sort._source.title%></h3>
                                <p><%sort._source.description%></p>
                                <label><%sort._source.created_at%> and:  </label><label><%sort._source.views%></label>
                                <span></span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <uib-pagination ng-change="pageChanged()" ng-model="currentPage" total-items="50" max-size="10" items-per-page="10" class="pagination-sm" boundary-link-numbers="true" id="crap"></uib-pagination>

        </div>
    </div>

@endsection
