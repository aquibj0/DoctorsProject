<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $table = 'contact_us';
    public $primarykey = 'id';
    public $timestamp = true;
}
