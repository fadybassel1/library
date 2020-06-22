<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reader extends Model
{
  use SoftDeletes;
  protected  $guarded = [];

  public function photo()
  {
    return $this->morphOne('App\Photo', 'photoable');
  }

  public function visits()
  {
    return $this->belongsToMany('App\Visit');
  }
}
