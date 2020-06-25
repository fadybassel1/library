<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reader extends Authenticatable
{
    use Notifiable;
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
