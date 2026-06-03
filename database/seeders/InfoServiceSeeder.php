<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InfoServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'judul' => 'Form Permohonan Informasi',
                'deskripsi' => 'Ajukan permohonan informasi publik yang Anda butuhkan dengan mudah dan cepat.',
                'icon' => 'icons/form_permohonan.png',
                'nama_button' => 'Ajukan Permohonan',
                'url' => '/permohonan',
            ],
            [
                'judul' => 'Form Pengajuan Keberatan',
                'deskripsi' => 'Jika Anda merasa ada informasi yang kurang jelas atau permohonan informasi tidak terpenuhi, ajukan keberatan Anda melalui form ini.',
                'icon' => 'icons/form_keberatan.png',
                'nama_button' => 'Ajukan Keberatan',
                'url' => '/pengajuan',
            ]
        ];
    
        foreach ($data as &$item) {
            $item['created_at'] = now();
            $item['updated_at'] = now();
        }

        DB::table('info_services')->insert($data);
    }
}
