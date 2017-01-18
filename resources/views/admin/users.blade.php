@extends('layouts.app')

@section('pageTitle', 'Admin')

@section('content')
{!!Html::script('js/site/my-articles.js')!!}
{!!Html::script('js/site/profile.js')!!}
<div class="container" >
    @include('flash::message')
    <div class="content" >
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="table-responsive">
                    <table class="table table-striped table-hover profile">
                        <tr>
                            <th>№</th>
                            <th>Avatar</th>
                            <th>NickName</th>
                            <th>Email</th>
                            <th>FirstName</th>
                            <th>LastName</th>
                            <th>Registration Date</th>
                            <th>Actions</th>
                        </tr>
                        @foreach ($users as $key => $user)
                            <tr id="tr{{$user['id']}}">
                                <th class="col-md-1">{{$key+1}}</th>
                                <td class="col-md-1">
                                    <img class="comment_image" src="/images/avatars/{{$user['profile']['avatar'] ? $user['profile']['avatar'] : 'no-image.png'}}"/>
                                </td>
                                <td class="col-md-2">{{$user['name']}}</td>
                                <td class="col-md-2">{{$user['email']}}</td>
                                <td class="col-md-1">{{$user['profile']['firstname']}}</td>
                                <td class="col-md-1">{{$user['profile']['lastname']}}</td>
                                <td class="col-md-1">{{$user['created_at']}}</td>
                                <td class="col-md-1 active">
                                    <div class="btn-group-vertical">
                                        <a href="/profile/edit/{{$user['id']}}" class="btn btn-warning">Edit</a>
                                        <a href="/profile/delete/{{$user['id']}}" class="btn btn-danger delete">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
