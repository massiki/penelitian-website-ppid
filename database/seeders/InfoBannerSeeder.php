<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InfoBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('info_banners')->insert([
            [
                'judul' => 'RSUD Kesehatan Kerja',
                'deskripsi' => 'RSUD Kesehatan Kerja Provinsi Jawa Barat berkomitmen untuk memberikan layanan yang inovatif dan mudah diakses bagi masyarakat. Kami mendukung kebutuhan informasi publik dengan solusi teknologi modern untuk meningkatkan transparansi dan kualitas layanan.',
                'nama_button' => 'Ajukan Permohonan',
                'url' => '/permohonan',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
