<?php

namespace App\Services;

use App\Events\OtpRequested;
use App\Listeners\GenerateOtp;
use App\Models\Otp;
use App\Models\User;
use App\Repository\Interface\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

        $user = $this->isCorrectCode($data);

        if ($user) {
            $user->is_phone_verified = 1;
            $user->save();
            $token = $user->createTokenUser();
            $user->otp->delete();
            return ['user' => $user, 'token' => $token];
        } else {
            return throw ValidationException::withMessages([__('messages.fail')]);
        }
    }

    public function login($r)
    {

        if (!Auth::attempt(['phone' => $r['phone'], 'password' => $r['password']])) {
            throw ValidationException::withMessages([
                'phone' => [__('auth.fail')],
            ]);

        }


        if (!Auth::user()->is_phone_verified) {

            throw ValidationException::withMessages([
                'verify' => [__('messages.fail')]
            ]);
        }

        $user = Auth::user();
        $token = $user->createTokenUser();
        return ['user'=>$user,'token'=>$token];




    }

    public function restPassword($data)
    {
        try {
            
            $user = $this->isCorrectCode($data);
            $user->password = Hash::make($data['password']);
            $user->save();
            $user->otp->delete();
          $token = $user->createTokenUser();
            return ['user'=>$user , 'token'=>$token];
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function sendCode($data)
    {
        try {
            $user = $this->repo->checkPhone($data['phone']);
            if (!$user) {
                throw ValidationException::withMessages(['phone' => __('messages.incorrect_phone')]);
            }
            $otp = Otp::getOtp($user->phone);
            if ($otp) {
                throw ValidationException::withMessages([__('messages.wait') . ' ' . now()->diffInSecond($otp->expires_at) . ' ' . __('messages.second')]);
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


    public function isCorrectCode($data)
    {

        $user = $this->repo->checkPhone($data['phone']);

        if (!$user) {
             throw ValidationException::withMessages(['phone' => __('messages.incorrect_phone')]);
        }

        $otp = Otp::getOtp($data['phone']);

        if (!$otp) {
             throw ValidationException::withMessages(['otp' => __('messages.expired')]);
        }

        if ($user->otp->code != $data['code']) {
             throw ValidationException::withMessages(['otp' => __('messages.fail')]);
        }

        return $user;


    }
}
