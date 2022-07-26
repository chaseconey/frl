<?php

namespace Database\Factories;

use App\Models\Protest;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProtestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Protest::class;

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
