<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use Translatable , InteractsWithMedia;

    public $translatedAttributes = ['name'];



    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }
        public function products()
    {
        return $this->hasMany(Product::class);
    }
}
