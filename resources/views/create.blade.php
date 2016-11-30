@extends('layouts.app')

@section('pageTitle', 'Write an Article')

@section('content')
    {{--<link rel="stylesheet" href="{{ URL::asset('js/init.js') }}">--}}
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    {!!Html::script('js/init.js')!!}

    <div class="container blog_create_container">
        <div class="content">
            <div class="col-md-9 col-md-offset-2">
                <h3>Write an Article</h3>
                <br>
                    {!! Form::open(array('url'=>route('create-article'),'method'=>'POST', 'files'=>true)) !!}
                <div class="form-group">
                    {!! Form::label('title', 'Title') !!}
                    {!! Form::text('title', '', ['class'=>'form-control','id'=>'title']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('desc', 'Description') !!}
                    <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="top" title="Not required field, if empty - little part of text will become a description"></span>
                    {!! Form::textarea('desc', '', ['class'=>'form-control','id'=>'desc']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('input', 'Text') !!}
                    {!! Form::textarea('text', '', ['id'=>'input']) !!}
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
            </div>

        </div>
    </div>

@endsection

