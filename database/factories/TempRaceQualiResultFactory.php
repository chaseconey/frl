<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TempRaceQualiResult>
 */
class TempRaceQualiResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'race_id' => 1,
            'driver_id' => 1,
            'racing_number' => 1,
            'name' => $this->faker->name,
            'best_s1_time' => 1.23,
            'best_s2_time' => 1.23,
            'best_s3_time' => 1.23,
            'lap_delta' => 1.23,
            'best_s1_delta' => 1.23,
            'best_s2_delta' => 1.23,
            'best_s3_delta' => 1.23,
            'f1_team_id' => 1,
            'position' => $this->faker->numberBetween(1, 20),
            'best_lap_tire' => 'S',
            'codemasters_result_status' => 3,
            'best_lap_time' => 1.23
        ];
    }
}
