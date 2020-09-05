<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FailedPayment extends Model
{
    protected $table = 'failed_payements';
    public $primarykey = 'id';
    public $timestamp = true;
}
