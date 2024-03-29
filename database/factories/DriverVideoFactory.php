<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DriverVideoFactory extends Factory
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
            'video_url' => 'https://www.youtube.com/watch?v=fnLL6AzGQhM',
        ];
    }
}
