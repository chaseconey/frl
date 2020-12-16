<?php

namespace Database\Factories;

use App\Models\F1Number;
use Illuminate\Database\Eloquent\Factories\Factory;

class F1NumberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = F1Number::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'racing_number' => 1
        ];
    }
}
