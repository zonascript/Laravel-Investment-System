<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BasicSetting extends Model
{
    protected $table = 'basic_settings';

    protected $fillable = [
      'admin_total',
      'reference_bonus',
        'withdraw_status',
        'reference',
        'reference_id',
        'registration_status',
        'verify_status',
        'reCaptcha_status',
        'site_key',
        'secret_key',
        'currency',
        'symbol',
        'm_driver',
        'm_port',
        'm_host',
        'm_username',
        'm_password',
        'm_enc',
    ];
}
