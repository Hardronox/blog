@extends('layouts.app')

@section('content')
    <div class="container" >
        @include('flash::message')
        <div class="content" >
            <div class="col-md-8 col-md-offset-3">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>Avatar</th>
                        <td><img width="150px" height="150px" src="images/avatars/{{$user->profile->avatar}}" alt=""></td>
                    </tr>
                    <tr>
                        <th>UserName</th>
                        <td>{{$user->name}}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{$user->email}}</td>
                    </tr>
                    <tr>
                        <th>FirstName</th>
                        <td>{{$user->profile->firstname}}</td>
                    </tr>
                    <tr>
                        <th>LastName</th>
                        <td>{{$user->profile->lastname}}</td>
                    </tr>
                    <tr>
                        <th>Actions</th>
                        <td>
                            <button class="btn btn-info edit" >Edit Profile</button>
                            <a class="btn btn-danger" href="/deleteProfile">Delete Account</a>
                        </td>
                    </tr>

                </table>
            </div>

        </div>
    </div>

    @include('partials/modal-profile-edit', ['user' => $user])

@endsection
{{--@if ($abc=='bitch')--}}
{{--I love {{$abc}}es--}}
{{--@endif--}}
{{--@foreach($orders as $order)--}}
{{--{{$order}}--}}
{{--@endforeach--}}