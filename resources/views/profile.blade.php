@extends('layouts.app')

@section('pageTitle', 'My Profile')

@section('content')
    <script type="text/javascript">

    </script>
    {!!Html::script('js/profile.js')!!}
    <div class="container" >
        @include('flash::message')
        <div class="content" >
            <div class="col-md-6 col-md-offset-3">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>Avatar</th>
                        <td>
                            @if (isset($user->profile->avatar))
                                <img width="150px" height="150px" src="images/avatars/{{$user->profile->avatar}}" alt="">
                            @else
                                <img width="150px" height="150px" src="images/avatars/no-image.png" alt="">
                            @endif
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
                            @if (isset($user->profile->firstname))
                                {{$user->profile->firstname}}
                            @else
                                No information
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>LastName</th>
                        <td>
                            @if (isset($user->profile->lastname))
                                {{$user->profile->lastname}}
                            @else
                                No information
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Actions</th>
                        <td>
                            <a class="btn btn-info" href="/profile/articles" >My Articles</a>
                            <button class="btn btn-warning edit" >Edit Profile</button>
                            <a id="delete" class="btn btn-danger" href="/delete-profile" >Delete Account</a>
                        </td>
                    </tr>

                </table>
            </div>

        </div>
    </div>

    @include('partials/modal-profile-edit', ['user' => $user])

@endsection

{{--@foreach($orders as $order)--}}
{{--{{$order}}--}}
{{--@endforeach--}}