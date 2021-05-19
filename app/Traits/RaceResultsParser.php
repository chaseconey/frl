<?php

namespace App\Traits;

use App\Models\Driver;
use App\Models\F1Number;
use App\Models\F1Team;
use App\Models\Race;
use Illuminate\Support\Facades\DB;

trait RaceResultsParser
{

    /**
     * @param  array  $results
     * @param  Race  $race
     * @param  callable  $mapper
     * @throws \Throwable
     */
    protected function uploadResults(array $results, Race $race, callable $mapper): void
    {
        $teams = F1Team::pluck('id', 'codemasters_id');
        $numbers = F1Number::pluck('id', 'racing_number')->toArray();

        DB::beginTransaction();

        try {
            foreach ($results as $racingNumber => $result) {
                if (array_key_exists($racingNumber, $numbers)) {
                    $driver = Driver::where('f1_number_id', $numbers[$racingNumber])
                        ->where('division_id', $race->division_id)
                        ->first();

                    if ( ! $driver) {
                        throw new \Exception("Driver with number #{$racingNumber} not found");
                    }

                    $raceResult = $mapper($result);
                    $raceResult->race_id = $race->id;

                    $raceResult->driver_id = $driver->id;
                    $raceResult->f1_team_id = $teams[$result['driver']['m_teamId']];

                    $raceResult->save();
                }
            }
        } catch (\Exception $e) {
            DB::rollback();

            throw $e;
        }
    }

}
