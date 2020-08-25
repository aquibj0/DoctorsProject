<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    public $primarykey = 'id';
    public $timestamp = true;



    public function serviceRequests(){
        return $this->hasMany('App\ServiceRequest', 'service_id');
    }
}
