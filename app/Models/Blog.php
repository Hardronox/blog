<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;

    public function category()
    {
        return $this->hasOne('App\Models\BlogCategory','id', 'category_id');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Likes','type_id', 'id')->where('type','=','Blog');
    }
}
