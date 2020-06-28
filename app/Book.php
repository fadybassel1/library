<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
  use SoftDeletes;
  protected  $guarded = [];

  public function photo()
  {
    return $this->morphOne('App\Photo', 'photoable');
  }

  public function tags()
  {
    return $this->belongsToMany('App\Tag', 'book_tag');
  }

  public function readers()
  {
    return $this->belongsToMany('App\Reader', 'book_reader')->withPivot('date_read');
  }
}
