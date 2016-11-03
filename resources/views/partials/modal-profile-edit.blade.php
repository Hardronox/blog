<script type="text/javascript">
    $(document).ready(function(){
        $(".edit").click(function(){
            $("#myModal").modal('show');
        });
    });
</script>


<!-- Modal HTML -->
<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div style="width: 70%; margin-left:15%;">
                <h3>Edit Profile</h3>
                <br>
                {{--<form action="{{route('submit')}}" method="post">--}}
                {!! Form::open(array('url'=>route('edit-profile'),'method'=>'POST', 'files'=>true)) !!}

                <div style="float: left;">
                <label for="file">Avatar</label>
                {!! Form::file('image', array('id' =>'file')) !!}
                </div>
                <img width="150px" height="150px" style="margin-left: 35%;" src="images/avatars/{{$user->profile->avatar}}" alt="">
                <div class="form-group">
                    <label for="firstname">FirstName</label>
                    <input type="text" class="form-control" name="firstname" id="firstname" value="{{$user->profile->firstname}}">
                </div>

                <div class="form-group">
                    <label for="lastname">LastName</label>
                    <input type="text" class="form-control" name="lastname" id="lastname" value="{{$user->profile->lastname}}">
                </div>

                <input type="hidden" value="{{csrf_token()}}" name="_token">

                {!! Form::submit('Edit', array('class'=>'btn btn-success pull-right')) !!}
                {!! Form::close() !!}
                <div style="height: 40px;"></div>
        </div>
        </div>
    </div>
</div>

    {{--<div class="container" style="margin-top:35px">--}}
        {{--<div class="content" >--}}
            {{--<div class="col-md-9 col-md-offset-2">--}}
                {{--<h3>Create Article</h3>--}}
                {{--<br>--}}
                {{--<form action="{{route('submit')}}" method="post">--}}
                {{--{!! Form::open(array('url'=>route('submit'),'method'=>'POST', 'files'=>true)) !!}--}}
                {{--<div class="form-group">--}}
                    {{--<label for="title">Title</label>--}}
                    {{--<input type="text" name="title" class="form-control" id="title">--}}
                {{--</div>--}}

                {{--<div class="form-group">--}}
                    {{--<label for="desc">Description</label>--}}
                    {{--<input type="text" name="desc" class="form-control" id="desc">--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--<label for="pwd" id="input">Text</label>--}}
                    {{--<textarea name="text" id="input" ></textarea>--}}
                {{--</div>--}}
                {{--<input type="hidden" value="{{csrf_token()}}" name="_token">--}}

                {{--<div class="form-group">--}}
                    {{--<label for="sel1">Category</label>--}}
                    {{--<select class="form-control" name="category">--}}
                        {{--@foreach($category as $cat)--}}
                            {{--<option value="{{$cat->id}}">{{$cat->name}}</option>--}}
                        {{--@endforeach--}}
                    {{--</select>--}}
                {{--</div>--}}
                {{--<label for="file">Main Blog Image</label>--}}
                {{--{!! Form::file('image', array('id' =>'file')) !!}--}}
                {{--{!! Form::submit('Submit', array('class'=>'send-btn btn btn-success pull-right')) !!}--}}
                {{--{!! Form::close() !!}--}}
                {{--</form>--}}
            {{--</div>--}}

        {{--</div>--}}
    {{--</div>--}}
