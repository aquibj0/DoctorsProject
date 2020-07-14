<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClinicAppointment extends Model
{
    protected $table = 'clinic_appointment';
    public $primarykey = 'id';
    public $timestamp = true;
}
