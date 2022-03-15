<?php

namespace Tests\Unit\Traits;

use App\Exceptions\ResultsUploadError;
use App\Models\Division;
use App\Models\Driver;
use App\Models\F1Number;
use App\Models\Race;
use App\Models\RaceResult;
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
            'driverData' =>
                [
                    ['m_raceNumber' => 12, 'm_position' => 1],
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
            'driverData' => [
                [
                    'm_raceNumber' => 44, // Lewis Hamilton's number (can't be selected)
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
            'driverData' => [
                [
                    'm_raceNumber' => 44, // Lewis Hamilton's number (can't be selected)
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

    /**
     * @test
     */
    public function race_results_are_parsed_properly()
    {
        RaceResult::query()->delete();
        $division = Division::factory()->create(['name' => 'Test Div']);

        $race = Race::factory()->create(['division_id' => $division->id]);

        $stub = file_get_contents(storage_path('stubs/race-results.json'));
        $results = json_decode($stub, true);

        $resultDriverNumbers = collect($results['driverData'])->pluck('m_raceNumber');

        // Get the system IDs for the result's driver numbers so we can dynamically create drivers for each number in the division
        $f1Numbers = F1Number::whereIn('racing_number', $resultDriverNumbers)->pluck('id');

        foreach ($f1Numbers as $f1Number) {
            Driver::factory()->create([
                'division_id' => $division->id,
                'f1_number_id' => $f1Number,
                'f1_team_id' => 1, // They all drive for Mercedes apparently
            ]);
        }

        $this->uploadResults($results, $race, fn($results) => RaceResult::fromFile($results));

        $this->assertDatabaseCount('race_results', 11);
    }
}
