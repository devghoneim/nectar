<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['user_id','zone_id','area_id'];

    public function zone()
    {
        return $this->belongsTo(Zone::class,'zone_id');
    }


    public function area()
    {
        return $this->belongsTo(Area::class,'area_id');
    }

     public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
