<?php

namespace App\Traits;

use App\Exceptions\ResultsUploadError;
use App\Models\Driver;
use App\Models\F1Number;
use App\Models\F1Team;
use App\Models\Race;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait RaceResultsParser
{

    /**
     * @param  array  $results
     * @param  Race  $race
     * @param  callable  $mapper
     * @throws ResultsUploadError
     * @throws \Throwable
     */
    protected function uploadResults(array $results, Race $race, callable $mapper): void
    {
        if ($gaps = $this->hasMissingPositions($results)) {
            $encodedGaps = implode(',', $gaps);
            throw new ResultsUploadError("Result for position(s) {$encodedGaps} missing. Check for duplicate driver number.");
        }

        $teams = F1Team::active()->pluck('id', 'codemasters_id');
        $activeF1Numbers = F1Number::active()->pluck('id', 'racing_number')->toArray();

        $count = count($activeF1Numbers);
        Log::info("Found {$count} f1 numbers");

        DB::beginTransaction();

        try {
            foreach ($results as $racingNumber => $result) {
                if (array_key_exists($racingNumber, $activeF1Numbers)) {
                    $driver = Driver::where('f1_number_id', $activeF1Numbers[$racingNumber])
                        ->where('division_id', $race->division_id)
                        ->first();

                    if (! $driver) {
                        throw new ResultsUploadError("Driver with number #{$racingNumber} not found.");
                    }

                    $raceResult = $mapper($result);
                    $raceResult->race_id = $race->id;

                    $raceResult->driver_id = $driver->id;
                    $raceResult->f1_team_id = $teams[$result['driver']['m_teamId']];

                    $raceResult->save();
                } elseif ($result['race_data']['m_position'] > 0 && $result['race_data']['m_numLaps'] > 0) {
                    // This usually happens when someone comes in after the session has started
                    throw new ResultsUploadError("Driver with AI racing number (#{$racingNumber}) found, please correct data.");
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            throw $e;
        }
    }

    /**
     * Check to see if the results have any gaps in positions. This would usually indicate that 2 drivers had the same
     * driver number.
     *
     * @param  array  $results
     * @return bool
     */
    protected function hasMissingPositions(array $results): array
    {
        $possiblePositions = range(1, count($results));
        $positions = collect($results)->pluck('race_data.m_position')->sort()->toArray();
        $gaps = array_diff($possiblePositions, $positions);

        return $gaps;
    }
}
