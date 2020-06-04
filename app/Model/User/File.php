<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';
	
	protected $fillable = [
        'user_id',	'admin_id',	'post_id',	'comment_id',	'type',	'full_name', 'mime_type',
    ];
    public function user(){
    	$this->belongsTo('App\Model\User\User');
    }

    public function profile(){
    	return $this->belongsTo('App\Model\User\Profile');
    }

}
