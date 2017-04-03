        <!-- Modal edit-profile window -->
<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal_content">
                <h3>@lang('messages.edit profile')</h3>
                <br>
                {!! Form::open(array('method'=>'POST', 'files'=>true, 'id'=>'edit-profile-form')) !!}

                <div class="profile_avatar">
                    {!! Form::label('file', __('messages.avatar')) !!}
                    {!! Form::file('image', array('id' =>'file','accept'=>'image/*')) !!}
                </div>

                <img class="profile_image" src="{{Storage::url($avatar)}}" alt="">

                <div class="form-group">
                    {!! Form::label('firstname', __('messages.firstname')) !!}

                    {!! Form::text('firstname', $user->profile->firstname ?? '', ['class'=>'form-control','id'=>'firstname']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('lastname', __('messages.lastname')) !!}

                    {!! Form::text('lastname', $user->profile->lastname ?? '', ['class'=>'form-control','id'=>'lastname']) !!}
                </div>
                @if ($user->password=='new users password')
                    <div class="form-group">
                        {!! Form::label('pass',__('messages.new password')) !!}

                        {!! Form::password('password', ['class'=>'form-control','id'=>'pass']) !!}
                    </div>
                @endif
                {!! Form::token() !!}

                {!! Form::submit(__('messages.edit'), array('class'=>'btn success pull-right','id'=>'edit-profile-button')) !!}
                {!! Form::close() !!}
                <div class="modal_height"></div>
            </div>
        </div>
    </div>
</div>