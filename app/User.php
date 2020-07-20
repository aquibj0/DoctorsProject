<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userFirstName', 'userLastName', 'userPassword',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'userPassword', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
    * The role() function defines, user belongs to a role.
    */
    // public function role(){
    //     return $this->belongsTo('App\UserRole');
    // }

    /**
    * The patients() function defines, user has many patients.
    */
    // public function patients(){
    //     return $this->hasMany('App\PatientDetail');
    // }
    
}
