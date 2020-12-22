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
            'Mercedes',
            'Ferrari',
            'Red Bull Racing',
            'Renault',
            'Haas',
            'McLaren',
            'Racing Point',
            'Alfa Romeo',
            'Alpha Tauri',
            'Williams',
        ];

        foreach ($teams as $team) {
            F1Team::factory()->create(['name' => $team]);
        }
    }
}
