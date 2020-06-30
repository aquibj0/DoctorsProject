<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientDetail extends Model
{
    protected $table = 'patient_details';
    public $primarykey = 'id';
    public $timestamp = true;

    /**
    * The user() function defines, patient belongsTo User.
    */
    public function user(){
        return $this->belongsTo('App\User');
    }
}
