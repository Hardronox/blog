<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    public function category()
    {
        return $this->hasOne('App\BlogCategory','id');
    }

}
