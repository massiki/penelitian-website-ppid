<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'super_admin',
            'nip' => '1111111111111',
            'email' => 'super_admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'super_admin'
        ]);

        User::create([
            'name' => 'admin',
            'nip' => '2222222222222',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);
        
        User::create([
            'name' => 'operator',
            'nip' => '3333333333333',
            'email' => 'petugas@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'operator'
        ]);
    }
}
