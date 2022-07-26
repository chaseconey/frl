<?php

namespace Database\Factories;

use App\Models\Race;
use Illuminate\Database\Eloquent\Factories\Factory;

class RaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'race_time' => $this->faker->dateTimeThisYear(),
            'division_id' => $this->faker->numberBetween(1, 2),
            'track_id' => $this->faker->numberBetween(1, 20),
        ];
    }
}
