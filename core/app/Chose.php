<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chose extends Model
{
    protected $table = 'choses';

    protected $fillable = ['title','s_text','icon'];
}
