<?php

namespace App\Models;

use App\Models\Label;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
        use Translatable , InteractsWithMedia;

    protected $guarded = [] ;

    
    public $translatedAttributes = ['name', 'description'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
     public function brand()
    {
        return $this->belongsTo(brand::class);
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class,'label_product');
    }


}
