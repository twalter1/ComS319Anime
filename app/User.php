<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Get all of the users that this user is following
     */
    public function following()
    {

        return $this->belongsToMany( User::class, 'following_users', 'user_id', 'following_id' );

    }

    /**
     * Get all of the users that are followers of this user
     */
    public function followers()
    {

        return $this->belongsToMany( User::class, 'following_users', 'following_id', 'user_id' );

    }

    /**
     * Get all of the animes that this user is following
     */
    public function animes_following()
    {

        return $this->belongsToMany( Anime::class, 'following_animes', 'user_id', 'anime_id' );

    }
}
