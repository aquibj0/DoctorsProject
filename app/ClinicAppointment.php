<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClinicAppointment extends Model
{
    protected $table = 'clinic_appointment';
    public $primarykey = 'id';
    public $timestamp = true;


    public function clinic(){
        return $this->belongsTo('App\Clinic', 'clinic_id');
    }
}
