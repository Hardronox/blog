@extends('layouts.app')

@section('content')
<?php
    $url = 'http://oauth.vk.com/authorize';

    $params = array(
            'client_id'     => config('services.vkontakte.client_id'),
            'redirect_uri'  => config('services.vkontakte.redirect'),
            'scope'=> 'notify,email',
            'response_type' => 'code'
    );
?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('messages.login')</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail @lang('messages.address')</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">@lang('messages.password')</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> @lang('messages.remember me')
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">

                                <a href="/auth/facebook"><img width="35px" height="35px" src="{{Storage::url('public/images/site/facebook.png')}}" alt=""></a>

                                <a href={{$url . '?' . urldecode(http_build_query($params))}}><img width="35px" height="35px" src="{{Storage::url('public/images/site/vk.png')}}" alt=""></a>

                                <div class="pull-right">
                                    <a class="btn btn-link" href="{{ url('/password/reset') }}">@lang('messages.forgot your password')</a>

                                    <button type="submit" class="btn btn-primary">
                                        @lang('messages.login')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
