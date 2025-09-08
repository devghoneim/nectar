<?php

namespace App\Models;

use App\Models\Zone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Location extends Model
{
    protected $fillable = [
        'user_id',
        'zone',
        'area'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function zones()
{
    return $this->belongsTo(Zone::class);

}
}
