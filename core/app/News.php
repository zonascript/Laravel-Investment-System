<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = ['title','category_id','description'];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
