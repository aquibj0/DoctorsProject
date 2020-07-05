<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $table = 'service_request';
    public $primarykey = 'is';
    public $timestamp = true;

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }


    public function patient(){
        return $this->belongsTo('App\Patient', 'patient_id');
    }


    public function service(){
        return $this->belongsTo('App\Service', 'service_id');
    }


    public function askQuestion(){
        return $this->hasOne('App\AskAQuestion', 'service_req_id');
    }



}
