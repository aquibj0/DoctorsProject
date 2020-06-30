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
        'first_name', 'last_name', 'email', 'password', 'gender', 'date_of_birth', 'mobile_number', 
        'address_line_1', 'address_line_2', 'city', 'state', 'country', 'pincode', 'profile_picture',
    ];

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


    /**
    * The role() function defines, user belongs to a role.
    */
    public function role(){
        return $this->belongsTo('App\UserRole');
    }

    /**
    * The patients() function defines, user has many patients.
    */
    public function patients(){
        return $this->hasMany('App\PatientDetail');
    }
    
}
