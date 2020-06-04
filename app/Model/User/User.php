<?php

namespace App\Model\user;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile(){
        return $this->hasOne('App\Model\User\Profile');
    }

    public function files(){
        return $this->hasMany('App\Model\User\File');
    }

    public function posts(){
        return $this->hasMany('App\Model\User\Post');
    }

    public function likes(){
        return $this->hasMany('App\Model\User\Like');
    }

    public function notifications(){
        return $this->hasMany('App\Model\User\Notification');
    }
}
