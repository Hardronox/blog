@extends('layouts.app')

@section('pageTitle', 'My Profile')

@section('content')
<div class="container" >
    @include('flash::message')
    <div class="content" >
        <div class="col-md-6 col-md-offset-3">
            @if ($user->password=='new users password')
                <span id="profile_info" class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="top"
                      title="Test account has been created for you! You can edit your personal information and choose new password. After that, you can login via social and this new account!"></span>
            @endif
            <table class="table table-striped table-hover profile" >
                <tr>
                    <th>@lang('messages.avatar')</th>
                    <td>
                        <img class="image_proportions" id="image" src="{{Storage::url($avatar)}}" alt="">
                    </td>
                </tr>
                <tr>
                    <th>@lang('messages.username')</th>
                    <td>
                        {{$user->name}}
                    </td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>
                        {{$user->email}}
                    </td>
                </tr>
                <tr>
                    <th>@lang('messages.firstname')</th>
                    <td id="first">
                        {{$user->profile->firstname ?? 'No information'}}
                    </td>
                </tr>
                <tr>
                    <th>@lang('messages.lastname')</th>
                    <td id="last">
                        {{$user->profile->lastname ?? 'No information'}}
                    </td>
                </tr>
                <tr>
                    <th>@lang('messages.actions')</th>
                    <td>
                        <a class="btn primary" href="{{ url("/profile/articles")}}" >@lang('messages.my articles')</a>
                        <button class="btn info edit" >@lang('messages.edit profile')</button>
                        <a id="delete" class="btn danger" href="{{ url("/profile/delete")}}" >@lang('messages.delete account')</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

@include('partials/modal-profile-edit', ['user' => $user])

@endsection
