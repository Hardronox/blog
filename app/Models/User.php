<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
/**
 * App\Models\User
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Articles[] $blogs
 * @property-read \App\Models\UsersProfile $profile
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
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
        'name', 'email', 'password', 'status'
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
            UsersProfile::where(['user_id'=> $user['id']])->delete();
        });
    }

    public function blogs()
    {
        return $this->hasMany('App\Models\Articles');
    }

    public function profile()
    {
        return $this->hasOne('App\Models\UsersProfile');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'user_role', 'user_id', 'role_id');
    }

    public function hasAnyRole($roles)
    {
        if(is_array($roles)) {
            foreach ($roles as $role) {
                $this->hasRole($role);
                return true;
            }
        } else {
            if($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if($this->roles()->where('name',$role)->first()) {
            return true;
        }
        return false;
    }

    public static function createBySocialProvider($providerUser)
    {
        return self::create([
            'email' => $providerUser->getEmail(),
            'username' => $providerUser->getNickname(),
            'name' => $providerUser->getName(),
        ]);
    }

}
