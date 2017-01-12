<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    const UPDATED_AT = NULL;
    const CREATED_AT = NULL;


    public function category()
    {
        return $this->hasOne('App\Models\BlogCategory','id', 'category_id');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Likes','type_id', 'id')->where('type','=','Comment');
    }

    public function commentAuthor()
    {
        return $this->hasOne('App\Models\UsersProfile','user_id', 'author_id');
    }
}
