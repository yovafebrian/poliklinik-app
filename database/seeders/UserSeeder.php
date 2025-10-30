<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'nama'=>'Admin',
                'email'=>'admin@gmail.com',
                'password'=>Hash::make ('admin'),
                'role'=>'admin',
            ],
            [
                'nama'=>'Dokter',
                'email'=>'dokter@gmail.com',
                'password'=>Hash::make ('dokter'),
                'role'=>'dokter',
            ],

        ];
       
        foreach($users as $user){
            User::create($user);
        }
    }
    
};
