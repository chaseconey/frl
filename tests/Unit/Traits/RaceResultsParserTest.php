<?php

namespace Tests\Unit\Traits;

use App\Exceptions\ResultsUploadError;
use App\Models\Race;
use App\Models\Track;
use App\Traits\RaceResultsParser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RaceResultsParserTest extends TestCase
{
    use RaceResultsParser, RefreshDatabase;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected $seed = true;

    /**
     * @test
     */
    public function error_thrown_when_position_missing()
    {
        $stub = file_get_contents(storage_path('stubs/race-with-missing-pos.json'));

        $results = json_decode($stub, true);
        $race = Race::factory()->make();

        $this->expectException(ResultsUploadError::class);
        $this->expectExceptionMessage('Result for position(s) 2 missing. Check for duplicate driver number.');

        $this->uploadResults($results, $race, fn($r) => "hi");
    }

    /**
     * @test
     */
    public function error_thrown_when_driver_missing()
    {

        $results = [
            '12' => [
                'driver' => [
                    'm_raceNumber' => 12,
                ],
                'race_data' => [
                    'm_position' => 1
                ]
            ]
        ];
        $race = Race::factory()->make(['division_id' => 1]);

        $this->expectException(ResultsUploadError::class);
        $this->expectExceptionMessage('Driver with number #12 not found.');

        $this->uploadResults($results, $race, fn($r) => "hi");
    }

    /**
     * @test
     */
    public function error_thrown_when_result_has_ai_number()
    {
        $results = [
            '44' => [
                'driver' => [
                    'm_raceNumber' => 44, // Lewis Hamilton's number (can't be selected)
                ],
                'race_data' => [
                    'm_position' => 1,
                    'm_numLaps' => 1,
                ]
            ]
        ];
        $race = Race::factory()->make();

        $this->expectException(ResultsUploadError::class);
        $this->expectExceptionMessage('Driver with AI racing number (#44) found, please correct data.');

        $this->uploadResults($results, $race, fn($r) => "hi");
    }

    /**
     * @test
     */
    public function ai_results_with_no_race_data_are_ignored()
    {
        $results = [
            '44' => [
                'driver' => [
                    'm_raceNumber' => 44, // Lewis Hamilton's number (can't be selected)
                ],
                'race_data' => [
                    'm_position' => 1,
                    'm_numLaps' => 0,
                ]
            ]
        ];
        $race = Race::factory()->make();

        $this->uploadResults($results, $race, fn($r) => "hi");

        // AI (#44) and no laps == ignore
        $this->assertDatabaseCount('race_results', 0);
    }
}
