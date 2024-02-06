<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Department;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama_departemen' => $this->faker->word(mt_rand(2,5)),
            'kode_departemen' => $this->faker->bothify('???-###'),
            'singkatan_departemen' => $this->faker->regexify('([A-Z]){3}')
        ];
    }
}
