<?php

namespace App\Listeners;

use App\Events\OtpRequested;
use App\Models\Otp;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateOtp
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OtpRequested $event): void
    {

            Otp::updateOrCreate(['phone'=>$event->phone],[
                'user_id'=>$event->userId,
                'phone'=>$event->phone,
                'code'=>Otp::generateCode(),
                'type'=>$event->type,
                'expires_at'=>Carbon::now()->addMinute()

            ]);
    }
}
