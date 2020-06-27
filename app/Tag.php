<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = [];

    public function books(){
    return $this->belongsToMany('App\Book','book_tag');
    }
}
