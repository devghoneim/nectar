<?php

namespace App\Models;

use App\Models\Location;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $fillable = ['name'];

    public function locations()
    {
        return $this->hasMany(Location::class);
    }
}
