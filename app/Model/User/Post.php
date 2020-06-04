<?php

namespace App\Model\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $table = 'posts';
	
	protected $fillable = [
        'posted_by', 'title', 'subtitle', 'slug','status','body','image','like','dislike',
    ];


//sensitive path: make sure capitalization is correct

    public function admin(){
        return $this->hasOne('App\Model\Admin\Admin');
    }

    public function user(){
        return $this->hasOne('App\Model\User\User');
    }

    public function categories(){
    	return $this->belongsToMany('App\Model\User\Category','post_categories');
    }

    public function tags(){
    	return $this->belongsToMany('App\Model\User\Tag','post_tags');
    }

    public function comments(){
        return $this->hasMany('App\Model\User\Comment');
    }

    public function notifications(){
        return $this->hasMany('App\Model\User\notification');
    }

    public function getRouteKeyName(){
    	return 'slug';
    } 

}
