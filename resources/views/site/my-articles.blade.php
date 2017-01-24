@extends('layouts.app')

@section('pageTitle', 'My Articles')

@section('content')
    {!!Html::script('js/site/my-articles.js')!!}
    {!!Html::script('js/site/deleteObject.js')!!}
    <div class="container" >
        @include('flash::message')
        <div class="content" >
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-striped table-hover profile" width="100%">
                        <tr>
                            <th>№</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Views</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        @foreach ($blogs as $key => $blog)
                            <tr id="tr{{$blog['id']}}">
                                <th class="col-md-1">{{$key+1}}</th>
                                <td class="col-md-2"><a href="/blog/view/{{$blog['id']}}">{{$blog['title']}}</a></td>
                                <td class="col-md-4">{{$blog['description']}}</td>
                                <td class="col-md-1">{{$blog['views']}}</td>
                                <td class="col-md-1">{{$blog['created_at']}}</td>
                                <td class="col-md-1 status">{{$blog['status']}}</td>
                                <td class="col-md-1 active">
                                    <div class="btn-group-vertical">
                                        <button class="btn btn-info" data-id="{{$blog['id']}}" onclick="changeStatus(this);">Change Status</button>
                                        <a href="{{ url("/article/edit/".$blog['id']."")}}" class="btn btn-warning">Edit</a>
                                        <a href="{{ url("/article/delete/".$blog['id']."")}}" class="btn btn-danger delete">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
