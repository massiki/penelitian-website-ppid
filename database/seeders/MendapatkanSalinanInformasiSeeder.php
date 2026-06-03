<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MendapatkanSalinanInformasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['mendapatkan_salinan_informasi' => 'mengambil langsung'],
            ['mendapatkan_salinan_informasi' => 'email']
        ];
    
        foreach ($data as &$item) {
            $item['created_at'] = now();
            $item['updated_at'] = now();
        }
    
        DB::table('mendapatkan_salinan_informasi')->insert($data);
    }
}
