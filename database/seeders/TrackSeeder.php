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
            ['Melbourne Grand Prix Circuit', 'AU'],
            ['Bahrain International Circuit', 'BH'],
            ['Hanoi Circuit', 'VN'],
            ['Shanghai International Circuit', 'CN'],
            ['Circuit Zandvoort', 'NL'],
            ['Circuit de Barcelona-Catalunya', 'ES'],
            ['Circuit de Monaco', 'MC'],
            ['Baku City Circuit', 'AZ'],
            ['Circuit Gilles-Villeneuve', 'CA'],
            ['Circuit Paul Ricard', 'FR'],
            ['Spielberg', 'AU'],
            ['Silverstone Circuit', 'UK'],
            ['Hungaroring', 'HU'],
            ['Circuit De Spa-Francorchamps', 'BE'],
            ['Autodromo Nazionale Monza', 'IT'],
            ['Marina Bay Street Circuit', 'SG'],
            ['Sochi Autodrom', 'RU'],
            ['Suzuka International Racing Course', 'JP'],
            ['Circuit of The Americas', 'US'],
            ['Autódromo Hermanos Rodríguez', 'MX'],
            ['Autódromo José Carlos Pace', 'BR'],
            ['Yas Marina Circuit', 'UAE'],
        ];

        foreach ($tracks as $track) {
            Track::factory()->create(['name' => $track[0], 'country' => $track[1]]);
        }
    }
}
