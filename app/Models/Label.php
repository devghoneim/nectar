<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    use Translatable;
    public $translatedAttributes = ['name'];

    public function products()
    {
        return $this->belongsToMany(Product::class,'label_product');
    }
    
}
