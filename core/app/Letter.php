<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    protected $table = 'letters';

    protected $fillable = ['subject','description'];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
