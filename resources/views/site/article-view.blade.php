@extends('layouts.app')

@section('pageTitle', $blog->title)

@section('content')
<div class="container" >
    <div class="content">
        <div class="col-md-7 col-md-offset-1 content-left">
            <div id="margin-top" class="article">
                <span id="view-h6">{{$blog->category->name}} </span>
                <span class="view-title">
                    {{$blog->title}}
                </span>
                <div>
                    <img id="blog-image" src="{{Storage::url($blog->image)}}" alt="" />
                </div>
                <div id="view-article">{!! $blog->text !!}</div>
                <div class="views_likes">
                    <div class="pull-right views">
                        {{$views}} <span class="glyphicon glyphicon-eye-open"></span>
                    </div>
                    @if (Auth::guest())
                        <div class="likes_block">
                            <a class="guest-hover">
                                <span id="likes">{{$likes}}</span><span class="glyphicon glyphicon-heart"></span>
                            </a>
                        </div>
                    @else
                        <div class="likes_block">
                            <a class="a-hover" data-type="Blog" data-post="{{$blog['id']}}">
                                <span id="likes">{{$likes}}</span><span class="glyphicon glyphicon-heart"></span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            <div id="comment_block">
                <ul class="media-list">
                    <script type="text/template" id="pageContent">
                        <li class="media">
                            <div id="m<%- comments.id %>">
                                <div class="media-left">
                                    <img class="comment_image" src="<%= comments.author_profile.avatar %>"/>
                                </div>
                                <div class="media-body">
                                    <a href="#"><span><%= comments.author_profile.firstname %> <%= comments.author_profile.lastname %></span></a>
                                    <p><%= comments.text %></p>
                                    <span><%= comments.created_at %>
                                        @if (Auth::guest())
                                            <a class="guest-hover pull-right">
                                            <span id="likes"><%= likes %></span><span class="glyphicon glyphicon-heart likes"></span>
                                        @else
                                            <a class="answer_button" data-id="<%= comments.id %>" data-name="<%= comments.author_profile.firstname %>">Answer</a>

                                            <a class="a-hover pull-right" data-type="Comment" data-post="<%- comments.id %>">
                                                <span id="likes"><%= likes %></span><span class="glyphicon glyphicon-heart likes"></span>
                                            </a>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </li>
                    </script>
                </ul>
            </div>
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
                            <button class="btn success btn-raised pull-right write-comment" type="button">Send</button>
                        </div>
                    {!! Form::close() !!}
                @endif
            </div>

        </div>

{{-- right ad column--}}
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
</div>
@endsection