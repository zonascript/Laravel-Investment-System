<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    protected $table = 'withdraws';

    protected $fillable = ['user_id',
        'method_id',
        'withdraw_number',
        'amount',
        'charge',
        'total',
        'new_balance',
        'old_balance',
        'message',
        'status',
        'made_date',
        'acc_name',
        'acc_number',
        'acc_code',
    ];
    public function withdrawMethod()
    {
        return $this->belongsTo(ManualPayment::class,'method_id');
    }
}
