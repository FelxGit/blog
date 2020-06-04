<?php

//please refer to user
namespace App\Model\Admin;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\Admin\Admin_Password_Reset_Notification;//
use App\Notifications\Admin\Admin_Email_Verify_Notification;//


class admin extends Authenticatable implements MustVerifyEmail
{

    use Notifiable;

    public function roles(){
        //admin_roles is called the pivot table(many to many relation table)
       return $this->belongsToMany('App\Model\Admin\Role','admin_roles'); 
    }
     

    protected $table = 'admins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $fillable = ['name', 'email', 'password', 'phone', 'status'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


//override from canresetpassword.php    
    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new Admin_Password_Reset_Notification($token));
    }


    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new Admin_Email_Verify_Notification);
    }
    
}
