<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [   
                'id' => 0,
                'status' => 'ditolak'
            ],
            [
                'id' => 1,
                'status' => 'diterima'
            ],
            [
                'id' => 2,
                'status' => 'dikirim'
            ],
            [
                'id' => 3,
                'status' => 'diproses'
            ],
        ];
    
        foreach ($data as &$item) {
            $item['created_at'] = now();
            $item['updated_at'] = now();
        }
    
        DB::table('status')->insert($data);
    }
}
