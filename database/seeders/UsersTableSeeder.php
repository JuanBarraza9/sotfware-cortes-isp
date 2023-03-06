<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            //Admin
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@correo.com',
                'password' => Hash::make('123123'),
                'role' => 'admin',
                'status' => 'active',
            ],
            //Empleado
            [
                'name' => 'Empleado',
                'username' => 'empleado',
                'email' => 'empleado@correo.com',
                'password' => Hash::make('123123'),
                'role' => 'empleado',
                'status' => 'active',
            ],
            //User
            [
                'name' => 'User',
                'username' => 'usuario',
                'email' => 'user@correo.com',
                'password' => Hash::make('123123'),
                'role' => 'user',
                'status' => 'active',
            ],

        ]);
    }
}
