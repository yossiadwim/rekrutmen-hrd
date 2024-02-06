<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_departemen' => $this->faker->numberBetween(1, 5),
            'nama_lowongan' => $this->faker->jobTitle(),
            'deskripsi' => $this->faker->text(250),
            'tanggal_dibuka' => $this->faker->date()

        ];
    }
}
