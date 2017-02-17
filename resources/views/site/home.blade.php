@extends('layouts.app')

@section('pageTitle', 'Home')

@section('content')
    <div ng-app="main" ng-controller="main" ng-cloak>
        <div class="container">
            <div class="header-bottom">
                <div class="type">
                    <h5>Article Types</h5>
                </div>
                <div class="list-nav">
                    <ul>
                        <li><a ng-click="loadData('Backend', 'true')">Backend</a></li>|
                        <li><a ng-click="loadData('Frontend', 'true')">Frontend</a></li>|
                        <li><a ng-click="loadData('Design', 'true')">Design</a></li>
                    </ul>
                    <!-- Left Side Of Navbar -->
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
        <div class="container" >
            <div class="content" >
                <div class="col-md-7 content-left">
                    <h5 class="head">recent</h5>
                    <div class="article" ng-repeat="blog in blogs">
                        <h6><%blog._source.category%> </h6>
                        <a target="_self" class="title home_a" href="/blog/<%blog._source.id%>">
                            <%blog._source.title%>
                        </a>



                        <img class="blog_image" src="images/blog/<% blog._source.image ? blog._source.image : 'no-image.png'%>" alt="" />



                        <p><%blog._source.description%></p>
                        <div class="pull-right blog_views"><%blog._source.views%> <span class="glyphicon glyphicon-eye-open"></span></div>
                        <span class="blog_date"><%blog._source.created_at.date%></span>
                    </div>

                </div>
                <div class="col-md-5 content-right">
                    <h5 class="head popular">Popular</h5>
                    <div class="content-right-top" ng-repeat="popular in populars">
                        <a target="_self" class="home_a" href="/blog/<%popular._source.id%>">
                            <div class="editor text-center">
                                <h3><%popular._source.title%></h3>
                                <p><%popular._source.description%></p>
                                <label><%popular._source.created_at.date%> and:  </label><label><%popular._source.views%></label>
                                <span></span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <uib-pagination ng-change="pageChanged()" ng-model="currentPage" total-items="totalItems" max-size="10" items-per-page="itemsPerPage" class="pagination-sm" boundary-link-numbers="true" id="pagi"></uib-pagination>
        </div>
    </div>
@endsection
