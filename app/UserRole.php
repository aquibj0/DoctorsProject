<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'roles';
    public $primarykey = 'id';
    public $timestamp = true;
}
