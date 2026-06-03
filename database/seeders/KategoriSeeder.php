<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kategori' => 'Berkala'],
            ['kategori' => 'Serta Merta'],
            ['kategori' => 'Setiap Saat'],
            ['kategori' => 'Dikecualikan'],
        ];
    
        foreach ($data as &$item) {
            $item['created_at'] = now();
            $item['updated_at'] = now();
        }
    
        DB::table('kategori_informasi')->insert($data);
    }
}
