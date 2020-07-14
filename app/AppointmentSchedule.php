<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppointmentSchedule extends Model
{
    protected $table = 'appointment_schedules';
    public $primarykey = 'id';
    public $timestamp = true;


    public function serviceRequest(){
        return $this->belongsTo('App\ServiceRequest');
    }



}
