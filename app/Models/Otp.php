<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Otp extends Model
{
    
        protected $fillable = [
        'user_id',
        'phone',
        'code',
        'type',
        'expires_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

      static function generateCode() : string
    {
        if (App::environment('production')) {
            return rand(1000, 9999);
        } else {
            return "1234";
        }
    }

    public static  function getOtp($phone) {

       return  static::where('phone',$phone)->where('expires_at','>=',now())->first();
    

    }

}
