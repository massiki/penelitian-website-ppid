<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BackgroundImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'slug' => 'logo',
                'image' => 'image/logo.jpeg' 
            ],
            [
                'slug' => 'banner',
                'image' => 'image/bg1.jpg' 
            ],
            [
                'slug' => 'banner',
                'image' => 'image/bg2.jpg' 
            ],
            [
                'slug' => 'banner',
                'image' => 'image/bg3.jpg' 
            ],
            [
                'slug' => 'thumbnail',
                'image' => 'image/v1.png' 
            ],
            [
                'slug' => 'thumbnail',
                'image' => 'image/v2.png' 
            ],
            [
                'slug' => 'q&a',
                'image' => 'image/Q&A.png' 
            ],
            
        ];
    
        foreach ($data as &$item) {
            $item['created_at'] = now();
            $item['updated_at'] = now();
        }

        DB::table('background_images')->insert($data);
    }
}
