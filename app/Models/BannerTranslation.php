<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerTranslation extends Model
{
    protected $table = 'banners_translations';
    protected $fillable=['title','sub_title'];
}
