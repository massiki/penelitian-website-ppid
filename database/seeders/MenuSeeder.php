<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menus')->insert([
            [
                'nama' => 'Beranda',
                'url' => '/',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Informasi Publik',
                'url' => '#',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Formulir',
                'url' => '#',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
