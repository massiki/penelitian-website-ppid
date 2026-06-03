<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReferencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'slug' => 'memperoleh',
                'number' => 1,
                'nama' => 'melihat/membaca/mendengar'
            ],
            [
                'slug' => 'memperoleh',
                'number' => 2,
                'nama' => 'mendapatkan salinan informasi sofcopy'
            ],
            [
                'slug' => 'memperoleh',
                'number' => 3,
                'nama' => 'mendapatkan salinan informasi hardcopy'
            ],
            [
                'slug' => 'mendapat',
                'number' => 1,
                'nama' => 'mengambil langsung'
            ],
            [
                'slug' => 'mendapat',
                'number' => 2,
                'nama' => 'email'
            ],
            [
                'slug' => 'pengajuan',
                'number' => 1,
                'nama' => 'permohonan informasi ditolak'
            ],
            [
                'slug' => 'pengajuan',
                'number' => 2,
                'nama' => 'informasi berkala tidak disediakan '
            ],
            [
                'slug' => 'pengajuan',
                'number' => 3,
                'nama' => 'permintaan informasi tidak ditanggapi'
            ],
            [
                'slug' => 'pengajuan',
                'number' => 4,
                'nama' => 'permintaan informasi ditanggapi tidak sebagaimana yang diminta'
            ],
            [
                'slug' => 'pengajuan',
                'number' => 5,
                'nama' => 'permintaan informasi tidak dipenuhi'
            ],
            [
                'slug' => 'pengajuan',
                'number' => 6,
                'nama' => 'biaya yang dikenakan tidak wajar'
            ],
            [
                'slug' => 'pengajuan',
                'number' => 7,
                'nama' => 'informasi disampaikan melebihi jangka waktu yang ditentukan'
            ],
            [
                'slug' => 'informasi',
                'number' => 1,
                'nama' => 'Berkala'
            ],
            [
                'slug' => 'informasi',
                'number' => 2,
                'nama' => 'Serta Merta'
            ],
            [
                'slug' => 'informasi',
                'number' => 3,
                'nama' => 'Setiap Saat'
            ],
            [
                'slug' => 'informasi',
                'number' => 4,
                'nama' => 'Dikecualikan'
            ],
            [
                'slug' => 'penyimpanan',
                'number' => 1,
                'nama' => 'selama masih berlaku'
            ],
            [
                'slug' => 'penyimpanan',
                'number' => 2,
                'nama' => '5 tahun'
            ],
            [
                'slug' => 'penyimpanan',
                'number' => 3,
                'nama' => '4 tahun'
            ],
            [
                'slug' => 'penyimpanan',
                'number' => 4,
                'nama' => '3 tahun'
            ],
            [
                'slug' => 'penyimpanan',
                'number' => 5,
                'nama' => '2 tahun'
            ],
            [
                'slug' => 'penyimpanan',
                'number' => 6,
                'nama' => '1 tahun'
            ],
        ];

        foreach ($data as &$item) {
            $item['created_at'] = now();
            $item['updated_at'] = now();
        }

        DB::table('references')->insert($data);
    }
}
