<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PermohonanInformasi>
 */
class PermohonanInformasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'email' => $this->faker->unique()->email(),
            'no_telepon' => $this->faker->phoneNumber(),
            'pekerjaan' => $this->faker->jobTitle(),
            'alamat' => $this->faker->address(),
            'nik' => $this->faker->numerify('################'),
            'file_ktp' => $this->faker->url,
            'informasi_yang_dibutuhkan' => $this->faker->paragraph(),
            'alasan_penggunaan_informasi' => $this->faker->sentence(),
            'memperoleh_informasi_id' => $this->faker->numberBetween(1, 3),
            'mendapatkan_salinan_informasi_id' => $this->faker->numberBetween(4, 5),
            'status_id' => 2,
            'created_at' => $this->faker->dateTimeBetween('-5 year', 'now'),
        ];
    }
}
