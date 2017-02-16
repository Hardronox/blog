<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SocialAccount
 *
 * @mixin \Eloquent
 */
class SocialAccount extends Model
{
    protected $table='user_social_account';

    const CREATED_AT = NULL;
    const UPDATED_AT = NULL;
}
