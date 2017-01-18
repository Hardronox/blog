<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    const UPDATED_AT = NULL;
    const CREATED_AT = NULL;

    public function article()
    {
        return $this->hasOne('App\Models\Articles','id', 'article_id');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Likes','type_id', 'id')->where('type','=','Comment');
    }

    public function author()
    {
        return $this->hasOne('App\Models\User','id', 'author_id');
    }

    public function authorProfile()
    {
        return $this->hasOne('App\Models\UsersProfile','user_id', 'author_id');
    }
}
