<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
        use Translatable;

    protected $fillable = ['sub_category_id', 'price'];

    
    public $translatedAttributes = ['name', 'description'];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
