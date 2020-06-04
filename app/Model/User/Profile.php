<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';
	//always
	protected $fillable = [
        'user_id', 'admin_id', 'file_id', 'intro','name','email','gender','hobby','current_city','hometown',
    ];

    public function getRouteKeyName(){
    	return 'name';
    }

    public function user(){
        return $this->belongsTo('App\Model\User\User');
    }

    public function files(){
    	return $this->hasMany('App\Model\User\File');
    }

}
