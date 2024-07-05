<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Driver>
 */
class DriverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'age' => $this->faker->numberBetween(20, 60),
            'phone' => fake()->phoneNumber(),
            'nik' => fake()->numerify('################'),
            'sim' => fake()->numerify('#############'),
            'address' => fake()->address(),
        ];
    }
}
