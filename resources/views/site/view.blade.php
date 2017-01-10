@extends('layouts.app')

@section('pageTitle', $blog->title)

@section('content')
    {!!Html::script('js/site/likes.js')!!}
    {{--{!!Html::script('js/site/comments.js')!!}--}}
    <div class="container" >
        <div class="content">
            <div class="col-md-9 content-left">
                <div class="article">
                    <h6>{{$blog->category->name}} </h6>
                    <a class="title">
                        {{$blog->title}}
                    </a>
                    <img class="blog-image" height="300px" src="/images/blog/{{$blog->image ? $blog->image : 'no-image.png'}}" alt="" />
                    <p>{{$blog->text}}</p>
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
                                    <span class="likes">{{$likes}}</span><span class="glyphicon glyphicon-heart"></span>
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
    </div>
@endsection