<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManualFund extends Model
{
    protected $table = 'manual_funds';

    protected $fillable = ['manual_fund_log_id','amount','message','user_id'];

    public function log()
    {
        return $this->belongsTo(ManualFundLog::class,'manual_fund_log_id');
    }


}
