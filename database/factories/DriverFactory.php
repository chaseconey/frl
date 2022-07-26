<?php

namespace Database\Factories;

use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\Factory;

class DriverFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Driver::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'division_id' => 1,
            'user_id' => $this->faker->numberBetween(1, 10),
            'name' => $this->faker->name,
            'f1_number_id' => 1,
            'f1_team_id' => $this->faker->numberBetween(1, 10),
            'type' => 'FULL_TIME',
        ];
    }
}
