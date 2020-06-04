<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    protected $table = 'roles';

    protected $fillable = ['name']; 

    public function roles(){
       return $this->belongsToMany('App\Model\Admin\Admin','admin_roles');
    }
}
