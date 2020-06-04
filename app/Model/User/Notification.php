<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id', 'admin_id', 'notification',
    ];

    public function user(){
    	$this->belongsTo('App\Model\User\User');
    }
}
