<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    public function category()
    {
        return $this->hasOne('App\Models\BlogCategory','id', 'category_id');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Likes','type_id', 'id')->where('type','=','Blog');
    }
}
