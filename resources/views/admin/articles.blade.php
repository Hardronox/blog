@extends('layouts.app')

@section('pageTitle', 'Admin')

@section('content')
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
                            <th>Premium</th>
                            <th>Actions</th>
                        </tr>
                        @foreach ($articles as $key => $article)
                            <tr id="tr{{$article['id']}}">
                                <th class="col-md-1">{{$key+1}}</th>
                                <td class="col-md-2"><a href="{{ url("/blog/view/".$article['id']."")}}">{{$article['title']}}</a></td>
                                <td class="col-md-3">{{$article['description']}}</td>
                                <td class="col-md-1">{{Redis::get("article/".$article['id']."/views") ?? 0}}</td>
                                <td class="col-md-1">{{$article['created_at']}}</td>
                                <td class="col-md-1 status">{{$article['status']}}</td>
                                <td class="col-md-1 premium">{{ ($article['premium']==='free') ? 'Free' : 'Premium'}}</td>
                                <td class="col-md-1 active">
                                    <div class="btn-group-vertical">
                                        <button class="btn primary make-premium" data-id="{{$article['id']}}">Change Premium Status</button>
                                        <a href="{{ url("/article/edit/".$article['id']."")}}" class="btn info">Edit</a>
                                        <a href="{{ url("/article/delete/".$article['id']."")}}" class="btn danger delete">Delete</a>
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
