<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientDocument extends Model
{
    protected $table = 'patient_documents';
    public $primarykey = 'id';
    public $timestamp = true;


    public function serviceRequest(){
        return $this->beongsTo('App\ServieRequest');
    }
}
