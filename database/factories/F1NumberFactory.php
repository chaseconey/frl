<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class F1NumberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'racing_number' => $this->faker->randomNumber(),
        ];
    }
}
