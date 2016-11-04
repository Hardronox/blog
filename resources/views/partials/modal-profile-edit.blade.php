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
                {!! Form::open(array('url'=>route('edit-profile'),'method'=>'POST', 'files'=>true)) !!}

                <div style="float: left;">
                    <label for="file">Avatar</label>
                    {!! Form::file('image', array('id' =>'file')) !!}
                </div>

                @if (isset($user->profile->avatar))
                    <img width="150px" height="150px" style="margin-left: 36%;" src="images/avatars/{{$user->profile->avatar}}" alt="">
                @else
                    <img width="150px" height="150px" style="margin-left: 36%;" src="images/avatars/no-image.png" alt="">
                @endif

                <div class="form-group">
                    <label for="firstname">FirstName</label>

                    @if (isset($user->profile->firstname))
                        <input type="text" class="form-control" name="firstname" id="firstname" value="{{$user->profile->firstname}}">
                    @else
                        <input type="text" class="form-control" name="firstname" id="firstname" value="">
                    @endif
                </div>

                <div class="form-group">
                    <label for="lastname">LastName</label>
                    @if (isset($user->profile->lastname))
                        <input type="text" class="form-control" name="lastname" id="lastname" value="{{$user->profile->lastname}}">
                    @else
                        <input type="text" class="form-control" name="lastname" id="lastname" value="">
                    @endif

                </div>

                <input type="hidden" value="{{csrf_token()}}" name="_token">

                {!! Form::submit('Edit', array('class'=>'btn btn-success pull-right')) !!}
                {!! Form::close() !!}
                <div style="height: 40px;"></div>
        </div>
        </div>
    </div>
</div>