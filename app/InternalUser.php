<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InternalUser extends Model
{
    protected $table = 'internal_user';
    public $primarykey = 'id';
    public $timestamp = true;



  
}
