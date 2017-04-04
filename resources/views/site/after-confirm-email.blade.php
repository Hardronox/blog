@extends('layouts.app')

@section('pageTitle', 'Welcome!')

@section('content')
    <div class="container blog_create_container">
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                <div class="msg_subcribers">
                    <h3><br>@lang('messages.your email was confirmed successfully! go to the') <a href="/">@lang('messages.main page!')</a></h3>
                </div>
            </div>
        </div>
    </div>
@endsection
