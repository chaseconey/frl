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
            'Ferari',
            'Red Bull',
            'Renault',
            'Haas',
            'McLaren',
            'Racing Point',
            'Alfa Romeo',
            'AlphaTauri',
            'Williams',
        ];

        foreach ($teams as $team) {
            F1Team::factory()->create(['name' => $team]);
        }
    }
}
