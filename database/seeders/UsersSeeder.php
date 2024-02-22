<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            //Admin
            [
                'name' => 'Md Emon',
                'username' => 'admin',
                'email' => 'mail.emon.bd123@gmail.com',
                'password' => Hash::make('M@il.Em0n'),
                'role' => 'admin',
                'status' => 'active',
            ],
            //Vendor
            [
                'name' => 'Limon Vendor',
                'username' =>'vendor',
                'email' => 'vendor@gmail.com',
                'password' =>  Hash::make('LimonVendor'),
                'role' =>'vendor',
                'status' => 'active',
            ],
            //User or Customer
            [
                'name' => 'User',
                'username' => 'user',
                'email' => 'user@gmail.com',
                'password' =>  Hash::make('User'),
                'role' => 'user',
                'status' => 'active',
            ],
        ];

        User::insert($users);
    }
}
