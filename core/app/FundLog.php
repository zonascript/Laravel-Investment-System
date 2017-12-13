<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FundLog extends Model
{
    protected $table = 'fund_logs';

    protected $fillable = ['user_id','payment_type','fix','percent','btc_amo','btc_acc','transaction_id','rate','amount','status'];
}
