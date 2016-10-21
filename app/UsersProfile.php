<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersProfile extends Model
{
    protected $table= 'users_profile';

    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
