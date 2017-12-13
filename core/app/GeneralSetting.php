<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    protected $table = 'general_settings';

    protected $fillable =[
        'title',
        'color',
        'logo',
        'address',
        'email',
        'number',
        'favicon',
        'facebook',
        'twitter',
        'google_plus',
        'linkedin',
        'youtube',
        'footer_bottom_text',
        'top_one',
        'top_two',
        'about_text'
        ];
}
