<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\InformasiPublik;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InformasiPublikDetail>
 */
class InformasiPublikDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'informasi' => $this->faker->text,
            'tahun' => $this->faker->year,
            'informasi_publik_id' => InformasiPublik::factory(),
            'link' => $this->faker->url,
            'created_at' => $this->faker->dateTimeBetween('-5 years', now()),
        ];
    }
}
