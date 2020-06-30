<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AskAQuestion extends Model
{
    protected $table = 'ask_a_question';
    public $primarykey = 'idSequence';
    public $timestamp = true;
}
