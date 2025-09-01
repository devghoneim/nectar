<?php

namespace App\Services;

use App\Events\OtpRequested;
use App\Listeners\GenerateOtp;
use App\Models\Otp;
use App\Repository\Interface\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthService
{


    public function __construct(private UserRepositoryInterface $repo) {}


    public function register($data)
    {
        $this->repo->create($data);
    }

    public function verify($data)
    {

        $user = $this->repo->checkPhone($data['phone']);

        if (!$user) {
            throw ValidationException::withMessages(['phone' => __('messages.incorrect_phone')]);
        }

        $otp = Otp::getOtp($data['phone']);
        if (!$otp) {
            throw ValidationException::withMessages(['otp' => __('messages.expired')]);
        }

        if ($data['code'] == $otp->code) {

            $user->is_phone_verified = 1;
            $token = $user->createTokenUser();
            $otp->delete();
            return ['user' => $user, 'token' => $token];
        } else {
            return throw ValidationException::withMessages([__('messages.fail')]);
        }
    }

    public function login($r)
    {

        if (!Auth::attempt(['phone'=>$r->phone ,'password'=>$r->password ])) {
            throw ValidationException::withMessages([
                'phone' => [__('auth.fail')]
            ]);
        }

        $user = Auth::user()->is_phone_verified;
        if (!$user) {
         
        throw ValidationException::withMessages([
                'verify' => [__('messages.fail')]
            ]);

        }
        $user->createTokenUser();




    }

    public function sendCode($data)
    {
        try {
            $user = $this->repo->checkPhone($data['phone']);
            if (!$user) {
                throw ValidationException::withMessages(['phone' => __('messages.incorrect_phone')]);
            }
            $otp = Otp::getOtp($user->phone);
            if ($otp->expires_at >= now()) {
                throw ValidationException::withMessages([__('messages.wait').' '.now()->diffInSeconds($otp->expires_at).' '.__('messages.second')]);
            }
            OtpRequested::dispatch($user->id, $user->phone, 'phone');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function logout($r)
    {

        $r->user()->currentAccessToken()->delete();
    }
}
