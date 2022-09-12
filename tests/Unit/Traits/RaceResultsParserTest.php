<?php

namespace Tests\Unit\Traits;

use App\Exceptions\ResultsUploadError;
use App\Models\Division;
use App\Models\Driver;
use App\Models\F1Number;
use App\Models\Race;
use App\Models\RaceResult;
use App\Models\TempRaceQualiResult;
use App\Models\TempRaceResult;
use App\Traits\RaceResultsParser;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class RaceResultsParserTest extends TestCase
{
    use RaceResultsParser, DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        // Disabling eventing so creating divisions doesn't try and create a discord role
        Event::fake();
    }

    /**
     * @test
     */
    public function missing_positions_check_when_position_missing()
    {
        $tempResults = TempRaceQualiResult::factory()
            ->count(3)
            ->sequence(fn ($sequence) => ['position' => ($sequence->index + 1) * 2])
            ->make();

        $missingPositions = $this->hasMissingPositions($tempResults);

        $this->assertNotEmpty($missingPositions);
    }

    /**
     * @test
     */
    public function missing_positions_check_when_no_missing_positions()
    {
        $tempResults = TempRaceQualiResult::factory()
            ->count(3)
            ->sequence(fn ($sequence) => ['position' => $sequence->index + 1])
            ->make();

        $missingPositions = $this->hasMissingPositions($tempResults);

        $this->assertEmpty($missingPositions);
    }

    /**
     * @test
     */
    public function dupe_check_when_driver_id_duplicated()
    {
        $tempResults = TempRaceQualiResult::factory()
            ->count(2)
            ->make([
                'driver_id' => 1
            ]);

        $dupes = $this->hasDuplicateRacingNumbers($tempResults);

        $this->assertNotEmpty($dupes);
    }

    /**
     * @test
     */
    public function driver_check_with_no_dupes()
    {
        $tempResults = TempRaceQualiResult::factory()
            ->count(2)
            ->sequence(fn ($sequence) => ['driver_id' => $sequence->index + 1])
            ->make();

        $dupes = $this->hasDuplicateRacingNumbers($tempResults);

        $this->assertEmpty($dupes);
    }

    /**
     * @test
     */
    public function unassigned_driver_check_with_nulls()
    {
        $tempResults = TempRaceQualiResult::factory()
            ->count(2)
            ->make([
                'driver_id' => null
            ]);

        $hasUnassigned = $this->hasUnassignedDrivers($tempResults);

        $this->assertTrue($hasUnassigned);
    }

    /**
     * @test
     */
    public function unassigned_driver_check_with_no_nulls()
    {
        $tempResults = TempRaceQualiResult::factory()
            ->count(2)
            ->make([
                'driver_id' => 1
            ]);

        $hasUnassigned = $this->hasUnassignedDrivers($tempResults);

        $this->assertFalse($hasUnassigned);
    }
}
