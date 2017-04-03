@extends('layouts.app')

@section('pageTitle', 'Edit an Article')

@section('content')
    {!!Html::script('/js/tinymce/js/tinymce/tinymce.min.js')!!}
    {!!Html::script('js/tinymce/init.js')!!}
    <div class="container container_tmargin">
        <div class="content">
            <div class="col-md-9 col-md-offset-2">
                <h3>@lang('messages.edit an article')</h3>
                <br>
                {!! Form::open(array('url'=>route("edit-article",['id'=>$article['id']]),'method'=>'POST', 'files'=>true, 'id'=>'edit-article')) !!}
                    {!! Form::token() !!}
                    <div class="form-group">
                        {!! Form::label('title', __('messages.title')) !!}
                        {!! Form::text('title', $article['title'], ['class'=>'form-control','id'=>'title']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('desc', __('messages.description')) !!}
                        {!! Form::textarea('desc', $article['description'], ['class'=>'form-control','id'=>'desc','rows'=>3]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('input', __('messages.text')) !!}
                        {!! Form::textarea('text', $article['text'], ['id'=>'input']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('sel1', __('messages.category')) !!}
                        {!! Form::select('category', $categories, ['class'=>'form-control','id'=>'sel1','selected'=>$article['category_id']]) !!}
                    </div>
                    {!! Form::label('file', __('messages.main article image')) !!}

                    <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="top"
                          title="@lang('messages.not required field, for better quality upload images with width 3 times more than height')"></span>

                    {!! Form::file('image', array('id' =>'file','accept'=>'image/*')) !!}
                    {!! Form::submit(__('messages.submit'), array('class'=>'send-btn btn success pull-right')) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

