<?php
namespace App\Services;

use App\Models\User;

class UserService 
{





    public function create($data)
    {
         $user = User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>$data['password'],
            'phone'=>$data['phone'],
        ]);

        return $user;
    }

    public function update($id)
    {
        
        $user = User::findOrFail($id);


    }

    public function delete()
    {
        
    }


    public function findUserByPhone($phone)
    {

        return User::where('phone', $phone)->firstOrFail();



    }




}