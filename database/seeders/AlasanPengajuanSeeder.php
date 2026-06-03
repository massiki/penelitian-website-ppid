<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlasanPengajuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['alasan_pengajuan' => 'permohonan informasi ditolak'],
            ['alasan_pengajuan' => 'informasi berkala tidak disediakan '],
            ['alasan_pengajuan' => 'permintaan informasi tidak ditanggapi'],
            ['alasan_pengajuan' => 'permintaan informasi ditanggapi tidak sebagaimana yang diminta'],
            ['alasan_pengajuan' => 'permintaan informasi tidak dipenuhi'],
            ['alasan_pengajuan' => 'biaya yang dikenakan tidak wajar'],
            ['alasan_pengajuan' => 'informasi disampaikan melebihi jangka waktu yang ditentukan'],
        ];
    
        foreach ($data as &$item) {
            $item['created_at'] = now();
            $item['updated_at'] = now();
        }
    
        DB::table('alasan_pengajuan')->insert($data);
    }
}
