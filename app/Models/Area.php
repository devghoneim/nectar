<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use Translatable;
    public $translatedAttributes = ['name'];

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }


}


