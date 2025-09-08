<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateOwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $owner =   User::create([
        'name'=>'owner',
        'email'=>'owner@ex.com',
        'phone'=>'00966511111100',
        'is_phone_verified'=>'1',
        'password'=>Hash::make('123456789')
      ]);

      $owner->assignRole('owner');

    }
}
