<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patient';
    public $primarykey = 'id';
    public $timestamp = true;

    /**
    * The user() function defines, patient belongsTo User.
    */
    public function user(){
        return $this->belongsTo('App\User');
    }


    public function patientDocuments(){
        return $this->hasMany('App\PatientDocument');
    }


    // public function serviceRequests(){
    //     return $this->hasMany('App\ServiceRequest', 'srPatientId');
    // }
}
