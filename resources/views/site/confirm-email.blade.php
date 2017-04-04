@extends('layouts.app')

@section('pageTitle', 'Check Email!')

@section('content')
    <div class="container blog_create_container">
        <div class="row">
            <div class="msg_subcribers">
                <h3><br>@lang('messages.email verification was sent. check your email!')</h3>
            </div>
        </div>
    </div>
@endsection
