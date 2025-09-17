<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
       protected $fillable = ['name', 'description'];
    public $timestamps = false;


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
