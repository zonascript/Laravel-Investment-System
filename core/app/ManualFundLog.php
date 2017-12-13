<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManualFundLog extends Model
{
    protected $table = 'manual_fund_logs';

    protected $fillable = ['user_id','amount','bank_id','charge','total','transaction_id'];

    public function method()
    {
        return $this->belongsTo(ManualBank::class,'bank_id');
    }

}
