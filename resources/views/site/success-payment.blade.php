@extends('layouts.app')

@section('pageTitle', 'Access Granted!')

@section('content')
    {!!Html::script('js/site/subscribe.js')!!}

    <div class="container blog_create_container">
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                <div class="msg_subcribers">
                    <h3>
                        @lang('messages.congratulations! you\'re a subscriber now! you now have access to all premium content on this site! get back to this article!')<br> <a href="{{ url("/post/$article->slug") }}">{{$article->title}}</a>
                        <br>
                    </h3>

                    <img id="access_granted" src="{{Storage::url("images/site/access-granted.jpg")}}" alt="">
                </div>
            </div>
        </div>
    </div>
@endsection
