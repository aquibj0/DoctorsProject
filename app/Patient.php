<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patient';
    public $primarykey = 'idSequence';
    public $timestamp = true;

    /**
    * The user() function defines, patient belongsTo User.
    */
    public function user(){
        return $this->belongsTo('App\User');
    }
}
