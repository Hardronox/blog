@extends('layouts.app')

@section('pageTitle', 'Admin')

@section('content')
    {!!Html::script('js/site/my-articles.js')!!}
    {!!Html::script('js/site/profile.js')!!}
    <div class="container" >
        @include('flash::message')
        <div class="content" >
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" width="100%">
                        <tr>
                            <th>№</th>
                            <th >Title</th>
                            <th class="tbl_align">Description</th>
                            <th class="tbl_align">Views</th>
                            <th class="tbl_align">Date</th>
                            <th class="tbl_align">Status</th>
                            <th class="tbl_align">Actions</th>
                        </tr>
                        @foreach ($articles as $key => $article)
                            <tr id="tr{{$article['id']}}">
                                <th class="col-md-1">{{$key+1}}</th>
                                <td class="col-md-2"><a href="/blog/view/{{$article['id']}}">{{$article['title']}}</a></td>
                                <td class="col-md-4">{{$article['description']}}</td>
                                <td class="col-md-1 tbl_align">{{$article['views']}}</td>
                                <td class="col-md-1 tbl_align">{{$article['created_at']}}</td>
                                <td class="col-md-1 tbl_align status">{{$article['status']}}</td>
                                <td class="col-md-2 active tbl_align">
                                    <div class="btn-group-vertical">
                                        <button  class="btn btn-info" data-id="{{$article['id']}}" onclick="status(this);">Change Status</button>
                                        <a href="/article/edit/{{$article['id']}}" class="btn btn-warning">Edit</a>
                                        <a href="/article/delete/{{$article['id']}}" class="btn btn-danger delete">Delete</a>
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
