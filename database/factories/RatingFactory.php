<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'star' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->sentence(),
            'permohonan_informasi_id' => $this->faker->unique()->randomElement([4, 8]),
        ];
    }
}
