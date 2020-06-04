<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $table = 'comments';

    protected $fillable = [
        'post_id', 'title', 'description', 'approve',
    ];

    public function post(){
    	return $this->belongsTo('App\Model\User\Post');
    }

    public function likes(){
    	return $this->hasMany('App\Model\User\Like');
    }
}
