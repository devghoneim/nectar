<?php

namespace App\Models;

use App\Models\Location;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use Translatable;
    public $translatedAttributes = ['name'];


    public function areas()
    {
        return $this->hasMany(Area::class,'zone_id');
    }


    



    

}
