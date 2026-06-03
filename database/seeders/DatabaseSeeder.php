<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InformasiPublik;
use App\Models\InformasiPublikDetail;
use App\Models\PengajuanKeberatan;
use App\Models\PermohonanInformasi;
use App\Models\Rating;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            StatusSeeder::class,
            UserSeeder::class,
            MenuSeeder::class,
            SubmenuSeeder::class,
            QuestAnswerSeeder::class,
            SosmedSeeder::class,
            BackgroundImageSeeder::class,
            ReferencesSeeder::class,
            PengajuanKeberatanSeeder::class,
            PermohonanInformasiSeeder::class,
            CardSeeder::class,
            VideoSeeder::class,
            ContactSeeder::class,
            InformasiSeeder::class,
            BeritaSeeder::class,
            InfoServiceSeeder::class,
            InfoBannerSeeder::class,
            LokasiSeeder::class
        ]);

        InformasiPublik::factory(250)->create();
        InformasiPublikDetail::factory(500)->recycle(InformasiPublik::all())->create();
        Rating::factory()->count(2)->create();
        PermohonanInformasi::factory(1000)->create();
        PengajuanKeberatan::factory(500)->create();
        // InformasiPublikDetail::factory()->count(100)->create();
    }
}
