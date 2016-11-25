<script type="text/javascript">
    $(document).ready(function(){
        $(".edit").click(function(){
            $("#myModal").modal('show');
        });
    });
</script>

<!-- Modal edit-profile window -->
<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div style="width: 70%; margin-left:15%;">
                <h3>Edit Profile</h3>
                <br>
                {!! Form::open(array('url'=>route('edit-profile'),'method'=>'POST', 'files'=>true)) !!}

                <div style="float: left;">
                    {!! Form::label('file', 'Avatar') !!}
                    {!! Form::file('image', array('id' =>'file')) !!}
                </div>

                @if (isset($user->profile->avatar))
                    <img width="150px" height="150px" style="margin-left: 36%;" src="images/avatars/{{$user->profile->avatar}}" alt="">
                @else
                    <img width="150px" height="150px" style="margin-left: 36%;" src="images/avatars/no-image.png" alt="">
                @endif

                <div class="form-group">
                    {!! Form::label('firstname', 'FirstName') !!}

                    @if (isset($user->profile->firstname))
                        {!! Form::text('firstname', $user->profile->firstname, ['class'=>'form-control','id'=>'firstname']) !!}
                    @else
                        {!! Form::text('firstname', '', ['class'=>'form-control','id'=>'firstname']) !!}
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::label('lastname', 'Lastname') !!}

                    @if (isset($user->profile->lastname))
                        {!! Form::text('lastname', $user->profile->lastname, ['class'=>'form-control','id'=>'lastname']) !!}
                    @else
                        {!! Form::text('lastname', '', ['class'=>'form-control','id'=>'lastname']) !!}
                    @endif
                </div>

                {!! Form::token() !!}

                {!! Form::submit('Edit', array('class'=>'btn btn-success pull-right')) !!}
                {!! Form::close() !!}
                <div style="height: 40px;"></div>
        </div>
        </div>
    </div>
</div>