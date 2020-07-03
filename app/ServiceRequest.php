<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $table = 'service_request';
    public $primarykey = 'idSequence';
    public $timestamp = true;

    public function user(){
        return $this->belongsTo('App\User', 'srUserId');
    }


    // public function patient(){
    //     return $this->belongsTo('App\Patient', 'srPatientId');
    // }



}
