        <!-- Modal edit-profile window -->
<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal_content">
                <h3>Edit Profile</h3>
                <br>
                {!! Form::open(array('method'=>'POST', 'files'=>true, 'id'=>'edit-profile-form')) !!}

                <div class="profile_avatar">
                    {!! Form::label('file', 'Avatar') !!}
                    {!! Form::file('image', array('id' =>'file','accept'=>'image/*')) !!}
                </div>

                <img class="profile_image" src="{{Storage::url($avatar)}}" alt="">

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
                @if ($user->password=='new users password')
                    <div class="form-group">
                        {!! Form::label('pass', 'New password') !!}

                        {!! Form::password('password', ['class'=>'form-control','id'=>'pass']) !!}
                    </div>
                @endif
                {!! Form::token() !!}

                {!! Form::submit('Edit', array('class'=>'btn success pull-right','id'=>'edit-profile-button')) !!}
                {!! Form::close() !!}
                <div class="modal_height"></div>
            </div>
        </div>
    </div>
</div>