@extends('layouts.app')

@section('pageTitle', $blog->title)

@section('content')
{!!Html::script('js/site/likes.js')!!}
{!!Html::script('js/site/comments.js')!!}
<div class="container" >
    <div class="content">
        <div class="col-md-8 col-md-offset-1 content-left">
            <div id="margin-top" class="article">
                <span id="view-h6">{{$blog->category->name}} </span>
                <span class="view-title">
                    {{$blog->title}}
                </span>
                <div>
                    <img id="blog-image" src="/images/blog/{{$blog->image ? $blog->image : 'no-image.png'}}" alt="" />
                </div>
                <div id="view-article">{!! $blog->text !!}</div>
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
            <ul class="media-list">
                <div id="blog_view_comment_content">
                    <script type="text/template" id="pageContent">
                        <li class="media">
                            <div id="m<%- comments.id %>">
                                <div class="media-left">
                                    <img class="comment_image" src="/images/avatars/<%= comments.author_profile.avatar ? comments.author_profile.avatar : 'no-image.png'%>"/>
                                </div>
                                <div class="media-body">
                                    <a href="#"><h5><%= comments.author_profile.firstname %> <%= comments.author_profile.lastname %></h5></a>
                                    <p><%= comments.text %></p>
                                    <p><%= comments.created_at %>
                                        @if (Auth::guest())
                                            <a class="a-hover pull-right">
                                            <span id="likes">{{$likes}}</span><span class="glyphicon glyphicon-heart likes"><%= likes %></span>                                            </a>
                                        @else
                                            <a class="comment_button" data-id="<%= comments.id %>" data-name="<%= comments.author_profile.firstname %>" onclick="answer(this)">Answer</a>

                                            <a class="a-hover pull-right" onclick="like(this);" data-type="Comment" data-post="<%- comments.id %>">
                                                <span id="likes"><%= likes %></span><span class="glyphicon glyphicon-heart likes"></span>
                                            </a>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </li>
                    </script>
                </div>
            </ul>
            <div id="blog_comment_form">
                @if (Auth::guest())
                    <b>Log in to leave a comment</b>
                @else
                    {!! Form::open(array('method'=>'POST', 'id'=>'comment_form')) !!}

                    <div class="form-group">
                        {!! Form::label('comment_text', 'Write comment here') !!}
                        {!! Form::textarea('text', '', ['class'=>'form-control', 'id'=>'comment_text', 'rows'=>3]) !!}
                    </div>
                    <div class="form-group">
                        <button class="btn btn-raised btn-success pull-right" type="button" onclick="saveComment(this);">Отправить</button>
                    </div>
                    {!! Form::close() !!}
                @endif
            </div>

        </div>

{{-- right ad column--}}
        <div class="col-md-3 content-right">
            <div class="content-right-top">
                @foreach($ads as $ad)
                    <a href="{{$ad->website}}">
                        <div class="editor text-center">
                            <img src="/images/advertisement/{{$ad->image}}" alt="">
                            {{$ad->title}}
                            <span></span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
@endsection