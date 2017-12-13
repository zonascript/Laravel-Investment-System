<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Strategy extends Model
{
    protected $table = 'strategies';

    protected $fillable = ['title','image','description'];
}
