<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'user_id',	'admin_id',	'comment_id', 'likes'
    ];

    public function comment(){
    	$this->belongsTo('App\Model\User\Comment');
    }

    public function user(){
    	$this->belongsTo('App\Model\User\User');
    }
}
