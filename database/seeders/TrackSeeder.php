<?php

namespace Database\Seeders;

use App\Models\Track;
use Illuminate\Database\Seeder;

class TrackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tracks = [
            ['Melbourne Grand Prix Circuit', 'Australia'],
            ['Bahrain International Circuit', 'Bahrain'],
            ['Hanoi Circuit', 'Vietnam'],
            ['Shanghai International Circuit', 'China'],
            ['Circuit Zandvoort', 'The Netherlands'],
            ['Circuit de Barcelona-Catalunya', 'Spain'],
            ['Circuit de Monaco', 'Monaco'],
            ['Baku City Circuit', 'Azerbaijan'],
            ['Circuit Gilles-Villeneuve', 'Canada'],
            ['Circuit Paul Ricard', 'France'],
            ['Spielberg', 'Austria'],
            ['Silverstone Circuit', 'Britain'],
            ['Hungaroring', 'Hungary'],
            ['Circuit De Spa-Francorchamps', 'Belgium'],
            ['Autodromo Nazionale Monza', 'Italy'],
            ['Marina Bay Street Circuit', 'Singapore'],
            ['Sochi Autodrom', 'Russia'],
            ['Suzuka International Racing Course', 'Japan'],
            ['Circuit of The Americas', 'USA'],
            ['Autódromo Hermanos Rodríguez', 'México'],
            ['Autódromo José Carlos Pace', 'Brazil'],
            ['Yas Marina Circuit', 'Abu Dhabi'],
        ];

        foreach ($tracks as $track) {
            Track::factory()->create(['name' => $track[0], 'country' => $track[1]]);
        }
    }
}
