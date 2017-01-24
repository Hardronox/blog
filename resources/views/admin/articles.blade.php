@extends('layouts.app')

@section('pageTitle', 'Admin')

@section('content')
    {!!Html::script('js/site/my-articles.js')!!}
    {!!Html::script('js/site/deleteObject.js')!!}
    <div class="container">
        @include('flash::message')
        <div class="content">
            <div class="row">
                @include('partials/admin-tabs', ['active' => 'articles'])
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
                        @foreach ($articles as $key => $article)
                            <tr id="tr{{$article['id']}}">
                                <th class="col-md-1">{{$key+1}}</th>
                                <td class="col-md-2"><a href="{{ url("/blog/view/".$article['id']."")}}">{{$article['title']}}</a></td>
                                <td class="col-md-4">{{$article['description']}}</td>
                                <td class="col-md-1">{{$article['views']}}</td>
                                <td class="col-md-1">{{$article['created_at']}}</td>
                                <td class="col-md-1 status">{{$article['status']}}</td>
                                <td class="col-md-1 active">
                                    <div class="btn-group-vertical">
                                        <button class="btn btn-info" data-id="{{$article['id']}}" onclick="changeStatus(this);">Change Status</button>
                                        <a href="{{ url("/article/edit/".$article['id']."")}}" class="btn btn-warning">Edit</a>
                                        <a href="{{ url("/article/delete/".$article['id']."")}}" class="btn btn-danger delete">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {{ $articles->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
