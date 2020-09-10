<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EncryptTrait;
class Reader extends Authenticatable
{
    use EncryptTrait;
    use Notifiable;
    use SoftDeletes;    
    protected  $guarded = [];

    protected $EncryptTrait = [
        'name',
        'phone',
        'email','church','streetname','region','city','country','church','churchlocation','churchcity','churchcountry'
        ,'schoolname','degree','job','company','servicename','servicechurch','buildingno'
    ];

    public function photo()
    {
        return $this->morphOne('App\Photo', 'photoable');
    }
    

    public function visits()
    {
        return $this->belongsToMany('App\Visit');
    }

    public function books()
    {
        return $this->belongsToMany('App\Book')->withPivot('date_read');
    }
}
