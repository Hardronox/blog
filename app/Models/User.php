<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
//use Zizaco\Entrust\Traits\EntrustUserTrait;
/**
 * App\User
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 */
class User extends Authenticatable
{
    //use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    protected static function boot() {
        parent::boot();

        static::deleting(function($user) { // before delete() method call this
            //var_dump('<pre>', 'kek', '</pre>');exit;
            UsersProfile::where(['user_id'=> $user['id']])->delete();
            // do the rest of the cleanup...
        });
    }


    public function blogs()
    {
        return $this->hasMany('App\Blogs');
    }
    public function profile()
    {
        return $this->hasOne('App\UsersProfile');
    }
}