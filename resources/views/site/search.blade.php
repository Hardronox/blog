@extends('layouts.app')

@section('pageTitle', 'Search')

@section('content')
    <div ng-app="main" ng-controller="search" ng-cloak>
        <div class="container" >
            <div class="content" >
                <div class="col-md-7 content-left">
                    <span><h2>@lang('messages.search results for'): "<%textToSearch%>". <%totalItems%> @lang('messages.articles found')</h2></span>
                    <div class="article" ng-repeat="blog in blogs">
                        <h6 class="main_category"><%blog._source.category%> </h6>
                        <div class="title-premium">
                            <div class="col-md-10">
                                <a target="_self" class="title home_link" href="/post/<%blog._source.slug%>">
                                    <%blog._source.title%>
                                </a>
                            </div>
                            <div>
                                <span ng-show="blog._source.premium == 'premium'" class="label label_warning pull-right">@lang('messages.premium')</span>
                            </div>
                        </div>

                        <img class="blog_image" src="{{Storage::url("<% blog._source.image %>")}}" />

                        <p><%blog._source.description%></p>
                        <div class="pull-right blog_views"><%blog._source.views%> <span class="glyphicon glyphicon-eye-open"></span></div>
                        <span class="blog_date"><%blog._source.created_at.date | microDate %></span>
                    </div>

                </div>
                <div class="col-md-3 content-right">
                    <div class="content-right-top">
                        @foreach($ads as $ad)
                            <a href="{{ url($ad->website)}}">
                                <div class="editor text-center">
                                    <img src="{{Storage::url($ad->image)}}" alt="">
                                    {{$ad->title}}
                                    <span></span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <uib-pagination ng-change="pageChanged()" ng-model="currentPage" total-items="totalItems" max-size="10" items-per-page="itemsPerPage" class="pagination-sm" boundary-link-numbers="true" id="pagi"></uib-pagination>
        </div>
    </div>
@endsection
