<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lokasi')->insert([
            'lokasi' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.3544569347328!2d107.82366707481009!3d-6.967444893033135!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68c5a437bca979%3A0x2bc91d56650228c!2sRSUD%20KESEHATAN%20KERJA%20PROVINSI%20JAWA%20BARAT%2FRSKK!5e0!3m2!1sen!2sid!4v1729052018726!5m2!1sen!2sid',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
