<?php

namespace Database\Factories;

use App\Models\Division;
use Illuminate\Database\Eloquent\Factories\Factory;

class DivisionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Division::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Division 1',
            'description' => $this->faker->sentence,
            'race_time' => $this->faker->time(),
            'day_of_week' => $this->faker->dayOfWeek,
            'discord_driver_role_id' => '',
            'discord_reserve_role_id' => '',
        ];
    }
}
