<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'categories';

	protected $fillable = [
        'name',
    ];

    public function posts(){
    	return $this->belongsToMany('app\model\user\post','post_categories');
    }
}
