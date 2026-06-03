<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SosmedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'WhatsApp',
                'link' => '#' ,
                'icon' => '<i class="fab fa-whatsapp"></i>' 
            ],
            [
                'nama' => 'Youtube',
                'link' => 'https://youtube.com/@rskkjabar3910?si=Ij_PJHEWoQDMfh8n' ,
                'icon' => '<i class="fab fa-youtube"></i>' 
            ],
            [
                'nama' => 'Instagram',
                'link' => 'https://www.instagram.com/rskk_jabar/' ,
                'icon' => '<i class="fab fa-instagram"></i>' 
            ],
            [
                'nama' => 'Facebook',
                'link' => 'https://www.facebook.com/RSUDKK?mibextid=ZbWKwL' ,
                'icon' => '<i class="fab fa-facebook-square"></i>' 
            ],
        ];
    
        foreach ($data as &$item) {
            $item['created_at'] = now();
            $item['updated_at'] = now();
        }

        DB::table('sosmeds')->insert($data);
    }
}
