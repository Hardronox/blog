<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UsersProfile
 *
 * @property int $id
 * @property int $user_id
 * @property string $firstname
 * @property string $lastname
 * @property string $avatar
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $created_at
 * @property-read \App\Models\User $users
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UsersProfile whereAvatar($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UsersProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UsersProfile whereFirstname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UsersProfile whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UsersProfile whereLastname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UsersProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UsersProfile whereUserId($value)
 * @mixin \Eloquent
 */
class UsersProfile extends Model
{
    protected $table= 'users_profile';

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
