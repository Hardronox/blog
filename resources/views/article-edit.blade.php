@extends('layouts.app')

@section('pageTitle', 'Edit an Article')

@section('content')
    {{--<link rel="stylesheet" href="{{ URL::asset('js/init.js') }}">--}}
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script src="/js/init.js"></script>

    <div class="container" style="margin-top:35px">
        <div class="content" >
            <div class="col-md-9 col-md-offset-2">
                <h3>Write an Article</h3>
                <br>
                {!! Form::open(array('url'=>route("edit-article",['id'=>$article['id']]),'method'=>'POST', 'files'=>true)) !!}
                    <div class="form-group">
                        {!! Form::label('title', 'Title') !!}
                        {!! Form::text('title', $article['title'], ['class'=>'form-control','id'=>'title']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('desc', 'Description') !!}
                        {!! Form::textarea('desc', $article['description'], ['class'=>'form-control','id'=>'desc']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('input', 'Text') !!}
                        {!! Form::textarea('text', $article['text'], ['id'=>'input']) !!}
                    </div>

                    {!! Form::token() !!}

                    <div class="form-group">
                        {!! Form::label('sel1', 'Category') !!}
                        {!! Form::select('category', $categories, ['class'=>'form-control','id'=>'sel1']) !!}
                    </div>
                    {!! Form::label('file', 'Main Blog Image') !!}

                    <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="top" title="For better quality upload images with width 3 times more than height"></span>

                    {!! Form::file('image', array('id' =>'file')) !!}
                    {!! Form::submit('Submit', array('class'=>'send-btn btn btn-success pull-right')) !!}
                {!! Form::close() !!}
                {{--</form>--}}
            </div>

        </div>
    </div>

@endsection

