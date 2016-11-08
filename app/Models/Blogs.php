<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    public function category()
    {
        return $this->hasOne('App\Models\BlogCategory','id', 'category_id');
    }

}
