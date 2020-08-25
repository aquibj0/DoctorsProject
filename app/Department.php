<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';
    public $primarykey = 'id';
    public $timestamp = true;



    public function serviceRequests(){
        return $this->hasMany('App\ServiceRequest', 'srDepartment');
    }
}
