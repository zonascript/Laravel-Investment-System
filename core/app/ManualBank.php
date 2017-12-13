<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManualBank extends Model
{
    protected $table = 'manual_banks';

    protected $fillable = ['name','acc_name','acc_number','acc_code','minimum','maximum','fix','percent'];
}
