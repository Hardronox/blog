@extends('layouts.app')

@section('pageTitle', 'My Articles')

@section('content')
    <div class="container" >
        @include('flash::message')
        <div class="content" >
            <div class="row">
                @if (sizeof($blogs)!==0)
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
                                    <td class="col-md-2"><a href="/blog/{{$blog['id']}}">{{$blog['title']}}</a></td>
                                    <td class="col-md-4">{{$blog['description']}}</td>
                                    <td class="col-md-1">{{$blog['views']}}</td>
                                    <td class="col-md-1">{{$blog['created_at']}}</td>
                                    <td class="col-md-1 status">{{$blog['status']}}</td>
                                    <td class="col-md-1 active">
                                        <div class="btn-group-vertical">
                                            <button class="btn primary change-status" data-id="{{$blog['id']}}">Change Status</button>
                                            <a href="{{ url("/article/edit/".$blog['id']."")}}" class="btn info">Edit</a>
                                            <a href="{{ url("/article/delete/".$blog['id']."")}}" class="btn danger delete">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @else
                    <h3 class="text-center">You don't have own articles. Write <a href="/article/write">now!</a></h3>
                @endif
            </div>
        </div>
    </div>
@endsection
