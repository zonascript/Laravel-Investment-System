<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManualPayment extends Model
{
    protected $table = 'manual_payments';

    protected $fillable = ['title','method_time','method_fix','method_percent','method_min','method_max','status'];
}
