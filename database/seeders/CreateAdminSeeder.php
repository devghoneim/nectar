<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
              'name'=>'admin',
        'email'=>'admin@ex.com',
        'phone'=>'00966511111101',
        'is_phone_verified'=>'1',
        'password'=>Hash::make('123456789')

        ]);

        $admin->assignRole('admin');
    }
}
