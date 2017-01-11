@extends('layouts.app')

@section('pageTitle', $blog->title)

@section('content')
    {!!Html::script('js/site/likes.js')!!}
    {!!Html::script('js/site/comments.js')!!}
    <div class="container" >
        <div class="content">
            <div class="col-md-9 content-left">
                <div class="article">
                    <h6>{{$blog->category->name}} </h6>
                    <a class="title">
                        {{$blog->title}}
                    </a>
                    <img class="blog-image" height="300px" src="/images/blog/{{$blog->image ? $blog->image : 'no-image.png'}}" alt="" />
                    <p>{!! $blog->text !!}</p>
                    <div class="views_likes">
                        <div class="pull-right views">
                            {{$blog->views}} <span class="glyphicon glyphicon-eye-open"></span>
                        </div>
                        @if (Auth::guest())
                            <a class="a-hover">
                                <span class="thumbs icon_wrap fa fa-thumbs-up likes">{{$likes}}</span>
                            </a>
                        @else
                            <div class="likes_block">
                                <a class="a-hover" onclick="like(this);"  data-type="Blog" data-post="{{$blog['id']}}">
                                    <span id="likes">{{$likes}}</span><span class="glyphicon glyphicon-heart"></span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>


{{-- right column--}}
            <div class="col-md-3 content-right">
                <div class="content-right-top">
                    <a href="single.html">
                        <div class="editor text-center">
                            Advertisement1
                            <span></span>
                        </div>
                    </a>
                    <a href="single.html">
                        <div class="editor text-center">
                            Advertisement2
                            <span></span>
                        </div>
                    </a>
                    <a href="single.html">
                        <div class="editor text-center">
                            Advertisement3
                            <span></span>
                        </div>
                    </a>
                    <a href="single.html">
                        <div class="editor text-center">
                            Advertisement4
                            <span></span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>


        <ul class="media-list">
            <div id="blog_view_comment_content" data-id="50" data-type="kek">
                <script type="text/template" id="pageContent">
                    <li class="media">
                        <div id="m<%- comments.id %>">
                            <div class="media-left">
                                <% if (comments.commentAuthor.avatar !== "NULL") { %>
                                <img width="100px" height="100px" src="/images/avatars/thumb/<%= comments.commentAuthor.avatar %>"/>
                                <% } else { %>
                                <img width="100px" height="100px" src="/images/avatars/thumb/_no-image" />
                                <% } %>
                            </div>
                            <div class="media-body">
                                <a href=""><h5><%= comments.commentAuthor.firstname %> <%= comments.commentAuthor.lastname %></h5></a>
                                <p><%= comments.comment_text %></p>
                                <p><%= date %>
                                    @if (Auth::guest())
                                    <a class="a-hover pull-right">
                                        <span class="thumbs icon_wrap fa fa-thumbs-up likes"><%= likes %></span>
                                    </a>
                                    @else
                                    <a class="comment_button" data-id="<%= comments.id %>" data-name="<%= comments.commentAuthor.firstname %>" onclick="answer(this)">Answer</a>

                                    <a class="a-hover pull-right" onclick="like(this);" data-type="Comment" data-post="<%- comments.id %>">
                                        <span class="thumbs icon_wrap fa fa-thumbs-up likes"> <%= likes %></span>
                                    </a>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </li>
                </script>
            </div>
        </ul>

    </div>
@endsection