<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminBalance extends Model
{
    protected $table = 'admin_balances';

    protected $fillable = ['user_id','details','charge','balance_type','balance','old_balance','new_balance'];
}
