<?php

namespace App\Traits;

use App\Exceptions\ResultsUploadError;
use App\Models\Driver;
use App\Models\F1Number;
use App\Models\F1Team;
use App\Models\Race;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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
        $driverData = collect($results['driverData']);
        $driverData = $this->cleanResults($driverData);

        if ($duplicates = $this->hasDuplicateRacingNumbers($driverData)) {
            $encodedDupes = implode(',', $duplicates);
            throw new ResultsUploadError("Racing numbers duplicated: {$encodedDupes}.");
        }

        $driverData = $driverData->keyBy('m_raceNumber')->sortBy('m_position');

        if ($gaps = $this->hasMissingPositions($driverData)) {
            $encodedGaps = implode(',', $gaps);
            throw new ResultsUploadError("Result for position(s) {$encodedGaps} missing. Check for duplicate driver number.");
        }

        $teams = F1Team::active()->pluck('id', 'codemasters_id');
        $activeF1Numbers = F1Number::active()->pluck('id', 'racing_number')->toArray();

        DB::beginTransaction();

        try {
            foreach ($driverData as $racingNumber => $result) {
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
                    $raceResult->f1_team_id = $teams[$result['m_teamId']];

                    $raceResult->save();
                } elseif ($result['m_position'] > 0 && $result['m_numLaps'] > 0) {
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
     */
    protected function hasMissingPositions(Collection $results): array
    {
        $possiblePositions = range(1, count($results));
        $positions = $results->pluck('m_position')->sort()->toArray();

        $gaps = array_diff($possiblePositions, $positions);

        return $gaps;
    }

    /**
     * By default, the game data exports 22 driver spots, even if they aren't filled. Let's clean that up.
     */
    private function cleanResults(Collection $results): Collection
    {
        return $results->where('m_position', '>', 0);
    }

    /**
     * Returns a list of duplicate racing numbers
     */
    protected function hasDuplicateRacingNumbers(Collection $driverData): array
    {
        return $driverData->countBy('m_raceNumber')->filter(fn ($value) => $value > 1)->keys()->toArray();
    }
}
