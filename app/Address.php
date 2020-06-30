<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';
    public $primarykey = 'addrId';
    public $timestamp = true;
}
