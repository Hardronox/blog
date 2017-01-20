@extends('layouts.app')

@section('pageTitle', 'My Profile')

@section('content')
{!!Html::script('js/site/deleteObject.js')!!}
<div class="container" >
    @include('flash::message')
    <div class="content" >
        <div class="col-md-6 col-md-offset-3">
            @if ($user->password=='new users password')
                <span id="profile_info" class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="top"
                      title="Test account has been created for you! You can edit your personal information and choose new password. After that, you can login via social and this new account!"></span>
            @endif
            <table class="table table-striped table-hover">
                <tr>
                    <th>Avatar</th>
                    <td>
                        <img class="image_proportions" src="images/avatars/{{$user->profile->avatar ? $user->profile->avatar : 'no-image.png'}}" alt="">
                    </td>
                </tr>
                <tr>
                    <th>UserName</th>
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
                    <th>FirstName</th>
                    <td>
                        {{$user->profile->firstname ? $user->profile->firstname : 'No information'}}
                    </td>
                </tr>
                <tr>
                    <th>LastName</th>
                    <td>
                        {{$user->profile->lastname ? $user->profile->lastname : 'No information'}}
                    </td>
                </tr>
                <tr>
                    <th>Actions</th>
                    <td>
                        <a class="btn btn-info" href="/profile/articles" >My Articles</a>
                        <button class="btn btn-warning edit" >Edit Profile</button>
                        <a id="delete" class="btn btn-danger" href="/profile/delete" >Delete Account</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

@include('partials/modal-profile-edit', ['user' => $user])

@endsection
