<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    protected $table = 'funds';

    protected $fillable = [
        'user_id',
        'payment_type',
        'transaction_id',
        'amount',
        'rate',
        'charge',
        'total',
    ];
}
