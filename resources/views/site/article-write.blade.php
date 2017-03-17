@extends('layouts.app')

@section('pageTitle', 'Write an Article')

@section('content')
    {!!Html::script('/js/tinymce/js/tinymce/tinymce.min.js')!!}
    {!!Html::script('js/tinymce/init.js')!!}
    <div class="container blog_create_container">
        <div class="content">
            <div class="col-md-9 col-md-offset-2">
                <h3>Write an Article</h3>
                <br>
                {!! Form::open(array('url'=>route('create-article'),'method'=>'POST', 'files'=>true, 'id'=>'write-article')) !!}

                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        {!! Form::label('title', 'Title') !!}
                        {!! Form::text('title', '', ['class'=>'form-control','id'=>'title']) !!}

                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        {!! Form::label('description', 'Description') !!}
                        <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="top"
                              title="Not required field, if empty - little part of text will become a description"></span>
                        {!! Form::textarea('description', '', ['class'=>'form-control','id'=>'desc','rows'=>3]) !!}

                        @if ($errors->has('description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                        {!! Form::label('input', 'Text') !!}
                        {!! Form::textarea('text', '', ['id'=>'input']) !!}

                        @if ($errors->has('text'))
                            <span class="help-block">
                                <strong>{{ $errors->first('text') }}</strong>
                            </span>
                        @endif
                    </div>

                    {!! Form::token() !!}

                    <div class="form-group">
                        {!! Form::label('sel1', 'Category') !!}
                        {!! Form::select('category', $categories, ['class'=>'form-control','id'=>'sel1','required'=>'true']) !!}
                    </div>
                    {!! Form::label('file', 'Main Blog Image') !!}

                    <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="top"
                          title="For better quality upload images with width 3 times more than height"></span>

                    {!! Form::file('image', array('id' =>'file','accept'=>'image/*')) !!}

                    {!! Form::submit('Submit', array('class'=>'send-btn btn success pull-right')) !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

