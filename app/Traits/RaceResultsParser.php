<?php

namespace App\Traits;

use App\Exceptions\ResultsUploadError;
use App\Models\Driver;
use App\Models\F1Number;
use App\Models\F1Team;
use App\Models\Race;
use App\Models\TempRaceResult;
use Illuminate\Support\Collection;

trait RaceResultsParser
{
    /**
     * @param array $results
     * @param Race $race
     * @param callable $mapper
     *
     * @throws ResultsUploadError
     * @throws \Throwable
     */
    protected function uploadResults(array $results, Race $race, callable $mapper): void
    {
        $driverData = collect($results['driverData']);
        $driverData = $this->cleanResults($driverData);

        $teams = F1Team::active()->pluck('id', 'codemasters_id');
        $activeF1Numbers = F1Number::active()->pluck('id', 'racing_number')->toArray();

        foreach ($driverData as $result) {
            $racingNumber = $result['m_raceNumber'];

            $driver = null;
            if (array_key_exists($racingNumber, $activeF1Numbers)) {
                $driver = Driver::where('f1_number_id', $activeF1Numbers[$racingNumber])
                    ->where('division_id', $race->division_id)
                    ->first();
            }


            $raceResult = $mapper($result);
            $raceResult->race_id = $race->id;

            $raceResult->driver_id = $driver?->id;
            $raceResult->f1_team_id = $teams[$result['m_teamId']];

            $raceResult->save();
        }
    }

    /**
     * By default, the game data exports 22 driver spots, even if they aren't filled. Let's clean that up.
     */
    private function cleanResults(Collection $results): Collection
    {
        return $results->where('m_position', '>', 0);
    }

    protected function validateTempResults($results)
    {
        if ($this->hasUnassignedDrivers($results)) {
            throw new \Exception("All results must have a driver assigned.");
        }

        if ($duplicates = $this->hasDuplicateRacingNumbers($results)) {
            $encodedDupes = implode(',', $duplicates);

            throw new \Exception("Racing numbers duplicated: {$encodedDupes}.");
        }

        if ($gaps = $this->hasMissingPositions($results)) {
            $encodedGaps = implode(',', $gaps);

            throw new \Exception("Result for position(s) {$encodedGaps} missing. Check for duplicate driver number.");
        }
    }

    /**
     * @var Collection<TempRaceResult>
     *
     * Returns a list of duplicate racing numbers
     */
    protected function hasUnassignedDrivers($tempResults): bool
    {
        return $tempResults->where('driver_id', null)->count() > 0;
    }

    /**
     * @var Collection<TempRaceResult>
     *
     * Returns a list of duplicate racing numbers
     */
    protected function hasDuplicateRacingNumbers($tempResults): array
    {
        return $tempResults->countBy('driver_id')->filter(fn ($value) => $value > 1)->keys()->toArray();
    }

    /**
     * @var Collection<TempRaceResult>
     *
     * Check to see if the results have any gaps in positions. This would usually indicate that 2 drivers had the same
     * driver number.
     */
    protected function hasMissingPositions($tempResults): array
    {
        $possiblePositions = range(1, count($tempResults));
        $positions = $tempResults->pluck('position')->sort()->toArray();

        $gaps = array_diff($possiblePositions, $positions);

        return $gaps;
    }
}
