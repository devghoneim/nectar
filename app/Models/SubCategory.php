<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
        use Translatable;

    protected $fillable = ['category_id'];
    public $translatedAttributes = ['name'];
   
   
   
    public function category()
    {
        return $this->belongsTo(Category::class);

    }

    public function products()
    {
        return $this->hasMany(Product::class);
        
    }
}
