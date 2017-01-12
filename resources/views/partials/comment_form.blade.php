<div id="blog_comment_form">
    @if (Auth::guest())
        <b>Log in to leave a comment</b>
    @else

        {!! Form::open(array('url'=>route('create-article'),'method'=>'POST', 'files'=>true, 'id'=>'comment_form')) !!}

        <div class="form-group">
            {!! Form::label('desc', 'Write comment here') !!}
            {!! Form::textarea('desc', $article['description'], ['class'=>'form-control','id'=>'comment_text']) !!}
        </div>


        <?= $form->field($comments, 'owner_name')->hiddenInput(['value'=> $type])->label(false)?>

        <div class="form-group">
            <button class="btn btn-raised btn-success pull-right" type="button" onclick="sav">Отправить</button>
        </div>
        {!! Form::button('Submit', array('class'=>'send-btn btn btn-success pull-right', 'onclick'=>"saveComment(this);")) !!}
        {!! Form::close() !!}
    @endif
</div>
