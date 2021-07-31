<?php

namespace Database\Seeders;

use App\Models\F1Team;
use Illuminate\Database\Seeder;

class F1TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = [
            ['name' => 'Mercedes', 'codemasters_id' => 0],
            ['name' => 'Ferrari', 'codemasters_id' => 1],
            ['name' => 'Red Bull Racing', 'codemasters_id' => 2],
            ['name' => 'Alpine', 'codemasters_id' => 5],
            ['name' => 'Haas', 'codemasters_id' => 7],
            ['name' => 'McLaren', 'codemasters_id' => 8],
            ['name' => 'Aston Martin', 'codemasters_id' => 4],
            ['name' => 'Alfa Romeo', 'codemasters_id' => 9],
            ['name' => 'Alpha Tauri', 'codemasters_id' => 6],
            ['name' => 'Williams', 'codemasters_id' => 3],
        ];

        foreach ($teams as $team) {
            F1Team::factory()->create($team);
        }
    }
}
