<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProtestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'race_id' => 1,
            'driver_id' => 1,
            'protested_driver_id' => 2,
            'video_url' => 'https://youtube.com/rawr',
            'description' => $this->faker->sentence(),
            'rules_breached' => $this->faker->sentence(),
        ];
    }
}
