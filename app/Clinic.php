<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    protected $table = 'clinic';
    public $primarykey = 'id';
    public $timestamp = true;


    public function appointments(){
        return $this->hasMany('App\AppointmentSchedule', 'appmntClinicid');
    }
}
