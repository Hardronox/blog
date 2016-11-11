@extends('layouts.app')

@section('content')
    {!!Html::script('js/likes.js')!!}
    <div class="container" >
        <div class="content">
            <div class="col-md-9 content-left">
                <div class="article">
                    <h6>{{$blog->category->name}} </h6>
                    <a class="title" href="single.html">
                        {{$blog->title}}
                    </a>
                    <img class="blog-image"  src="/images/blog/a1.jpg" alt="" />
                    <p>{{$blog->text}}</p>
                    <div style="margin-top: 10px">
                        <div class="pull-right" style="margin-right: 10px">
                            {{$blog->views}} <span class="glyphicon glyphicon-eye-open"></span>
                        </div>

                        @if (Auth::guest())
                            <a class="a-hover">
                                <span class="thumbs icon_wrap fa fa-thumbs-up likes">{{$likes}}</span>
                            </a>
                        @else
                            <div style="margin-left: 30px">
                                <a class="a-hover" onclick="like(this);"  data-type="Blog" data-post="{{$blog['id']}}">
                                    <span class="likes">{{$likes}}</span><span class="glyphicon glyphicon-heart"></span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
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
{{--@if ($abc=='bitch')--}}
{{--I love {{$abc}}es--}}
{{--@endif--}}
{{--@foreach($orders as $order)--}}
{{--{{$order}}--}}
{{--@endforeach--}}