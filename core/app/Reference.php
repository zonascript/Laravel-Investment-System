<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    protected $table = 'references';

    protected $fillable = [
      'user_id',
      'old_balance',
      'new_balance',
      'details',
      'reference_id',
      'under_reference',
      'balance',
    ];
}
