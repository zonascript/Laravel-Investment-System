<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compound extends Model
{
    protected $table = 'compounds';

    protected $fillable = ['name','compound'];
}
