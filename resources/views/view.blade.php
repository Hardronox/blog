@extends('layouts.app')

@section('content')
    <div class="container" >
        <div class="content" >
            <div class="col-md-9 content-left">
                <h5 class="head">recent</h5>
                <div class="article">
                    <h6>{{$blog->category->name}} </h6>
                    <a class="title" href="single.html">
                        {{$blog->title}}
                    </a>
                    <img src="/images/a1.jpg" alt="" />
                    <p>{{$blog->text}}</p>
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