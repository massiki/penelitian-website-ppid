<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PengajuanKeberatan>
 */
class PengajuanKeberatanFactory extends Factory
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
            'email' => $this->faker->unique()->safeEmail(),
            'no_telepon' => $this->faker->phoneNumber(),
            'pekerjaan' => $this->faker->jobTitle(),
            'alamat' => $this->faker->address(),
            'tujuan_penggunaan_informasi' => $this->faker->paragraph(),
            'alasan_pengajuan_id' => $this->faker->numberBetween(1, 5), // Sesuaikan dengan jumlah alasan yang ada
            'status_id' => 2, // Sesuai dengan default di migrasi
            'created_at' => $this->faker->dateTimeBetween('-5 years', now()),
        ];
    }
}
