<?php

namespace App\Console\Commands;

use App\Models\F1Number;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RandomizeDataFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'frl:randomize-file {path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Takes a data file and randomizes the racing numbers so that there are no dupes';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $path = $this->argument('path');

        $file = File::get($path);
        $contents = json_decode($file, true);

        // Get all current racing numbers
        $numbers = F1Number::active()->pluck('racing_number', 'id');

        // Go through and randomize the racing number
        foreach ($contents['driverData'] as $id =>  $driver) {
            $driver['m_raceNumber'] = $numbers[$id + 1];
            $contents['driverData'][$id] = $driver;
        }

        File::put($path, json_encode($contents));

    }
}
