@extends('layouts.app')

@section('content')
    {{--<link rel="stylesheet" href="{{ URL::asset('js/init.js') }}">--}}
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script src="js/init.js"></script>

    <div class="container" style="margin-top:35px">
        <div class="content" >
            <div class="col-md-9 col-md-offset-2">
                <h3>Create Article</h3>
                <br>
                    {!! Form::open(array('url'=>route('create-blog'),'method'=>'POST', 'files'=>true)) !!}
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title">
                    </div>

                    <div class="form-group">
                        <label for="desc">Description</label>
                        <input type="text" name="desc" class="form-control" id="desc">
                    </div>
                    <div class="form-group">
                        <label for="pwd" id="input">Text</label>
                        <textarea name="text" id="input" ></textarea>
                    </div>
                    <input type="hidden" value="{{csrf_token()}}" name="_token">

                    <div class="form-group">
                        <label for="sel1">Category</label>
                        <select class="form-control" name="category" id="sel1">
                            @foreach($category as $cat)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                <label for="file">Main Blog Image</label>

                <span class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="top" title="For better quality upload images with width 3 times more than height"></span>

                {!! Form::file('image', array('id' =>'file')) !!}
                {!! Form::submit('Submit', array('class'=>'send-btn btn btn-success pull-right')) !!}
                {!! Form::close() !!}
                {{--</form>--}}
            </div>

        </div>
    </div>

@endsection

