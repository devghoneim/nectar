<?php

namespace App\Repository\Elqount;

use App\Events\OtpRequested;
use App\Models\Otp;
use App\Models\User;
use App\Repository\Interface\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{

    public function create($data)
    {

        DB::beginTransaction();

        try {
            
         $user =  User::create([
                'name'=>$data['name'],
                'email'=>$data['email'],
                'password'=>$data['password'],
                'phone'=>$data['phone'],
            ]);

            OtpRequested::dispatch($user->id,$user->phone,'phone');

            DB::commit();
            return $user;


        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }


    }

    public function checkPhone($phone)
    {
       return User::where('phone',$phone)->first();
    }
}