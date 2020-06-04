<?php

namespace App\Model\Open;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
     protected $table = 'contacts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $fillable = ['name', 'email', 'phone','message'];

}
