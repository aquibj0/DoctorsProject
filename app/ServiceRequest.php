<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $table = 'service_request';
    public $primarykey = 'idSequence';
    public $timestamp = true;
}
