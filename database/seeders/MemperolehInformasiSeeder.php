<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemperolehInformasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['memperoleh_informasi' => 'melihat/membaca/mendengar'],
            ['memperoleh_informasi' => 'mendapatkan salinan informasi sofcopy'],
            ['memperoleh_informasi' => 'mendapatkan salinan informasi hardcopy'],
        ];
    
        foreach ($data as &$item) {
            $item['created_at'] = now();
            $item['updated_at'] = now();
        }
    
        DB::table('memperoleh_informasi')->insert($data);
    }
}
