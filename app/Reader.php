<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
  protected  $guarded=[];

  public function photo() {
    return $this->morphOne('App\Photo', 'photoable');
}

public function visits() {
  return $this->belongsToMany('App\Visit');
}

}
