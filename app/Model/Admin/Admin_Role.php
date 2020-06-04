<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class admin_role extends Model
{
     protected $table = 'admin_roles';

     protected $fillable = ['admin_id',	'role_id'];
}
