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
                            <th>Article</th>
                            <th>Comment</th>
                            <th>Author</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                        @foreach ($comments as $key => $comment)
                            <tr id="tr{{$comment['id']}}">
                                <th class="col-md-1">{{$key+1}}</th>
                                <td class="col-md-1"><a href="/blog/{{$comment['article']['id']}}">{{$comment['article']['title']}}</a></td>
                                <td class="col-md-2">{{$comment['text']}}</td>
                                <td class="col-md-2">{{$comment['author']['name']}}</td>
                                <td class="col-md-1">{{$comment['created_at']}}</td>
                                <td class="col-md-1 active">
                                    <div class="btn-group-vertical">
                                        <a href="/comment/delete/{{$comment['id']}}" class="btn btn-danger delete">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {{ $comments->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
