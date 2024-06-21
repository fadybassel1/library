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

  public function creator()
  {
    return $this->belongsTo('App\User', 'book_creator');
  }

  public function lastUpdater()
  {
    return $this->belongsTo('App\User', 'book_last_updated_by');
  }

  public function readers()
  {
    return $this->belongsToMany('App\Reader', 'book_reader')->withPivot('date_read');
  }

  protected static function booted(): void
  {
    static::creating(function (self $model) {
        $model->updated_at = null;
    });
  }
}
