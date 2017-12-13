<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $table = 'deposits';

    protected $fillable = ['deposit_number','user_id','plan_id','amount','status','percent','time','compound_id'];

    public function plan()
    {
        return $this->belongsTo(Plan::class,'plan_id');
    }
    public function compound()
    {
        return $this->belongsTo(Compound::class,'compound_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}


