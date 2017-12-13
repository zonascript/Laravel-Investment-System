<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = [
        'paypal_name',
        'paypal_image',
        'paypal_rate',
        'paypal_max',
        'paypal_min',
        'paypal_fix',
        'paypal_percent',
        'paypal_email',
        'perfect_name',
        'perfect_image',
        'perfect_rate',
        'perfect_max',
        'perfect_min',
        'perfect_fix',
        'perfect_percent',
        'perfect_account',
        'perfect_alternate',
        'btc_name',
        'btc_image',
        'btc_rate',
        'btc_max',
        'btc_min',
        'btc_fix',
        'btc_percent',
        'btc_api',
        'btc_xpub',
        'stripe_name',
        'stripe_image',
        'stripe_rate',
        'stripe_max',
        'stripe_min',
        'stripe_fix',
        'stripe_percent',
        'stripe_secret',
        'stripe_publisher',
        'paypal_status',
        'perfect_status',
        'btc_status',
        'stripe_status',

    ];
}
