<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    
    protected $table = 'tags';

    protected $fillable = [
        'name',
    ];

    public function posts(){
    	return $this->belongsToMany('app\model\user\post','post_tags');
    }
}
