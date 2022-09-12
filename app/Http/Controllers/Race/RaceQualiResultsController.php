<?php

namespace App\Http\Controllers\Race;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRaceQualiResultsRequest;
use App\Models\Driver;
use App\Models\DriverVideo;
use App\Models\Race;
use App\Models\RaceQualiResult;
use App\Models\TempRaceQualiResult;
use App\Traits\RaceResultsParser;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RaceQualiResultsController extends Controller
{
    use RaceResultsParser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Race $race)
    {
        $race->load(['qualiResults', 'qualiResults.driver', 'qualiResults.driver.user', 'qualiResults.f1Team'])
            ->loadMin('qualiResults', 'best_s1_time')
            ->loadMin('qualiResults', 'best_s2_time')
            ->loadMin('qualiResults', 'best_s3_time');

        $tempResults = TempRaceQualiResult::where('race_id', $race->id)->orderBy('position')->get();
        $drivers = Driver::where('division_id', $race->division_id)->get();

        $driverVideos = DriverVideo::where('race_id', $race->id)
            ->get()
            ->keyBy('driver_id');

        return view('races.race-quali-results.index')
            ->withDriverVideos($driverVideos)
            ->withRace($race)
            ->withTempResults($tempResults)
            ->withDrivers($drivers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Race  $race
     * @param  Request  $request
     * @return Response
     */
    public function store(Race $race, PostRaceQualiResultsRequest $request)
    {

        // Save changes to drivers (and whatever else we allow)
        foreach ($request->input('driver_id', []) as $position => $driverId) {
            $result = TempRaceQualiResult::where('race_id', $race->id)
                ->where('position', $position)
                ->first();

            $result->driver_id = $driverId;
            $result->save();
        }

        // Validate all the things
        $tempResults = TempRaceQualiResult::where('race_id', $race->id)
            ->get();

        try {
            $this->validateTempResults($tempResults);
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }

        // Convert temp results into real results
        foreach ($tempResults as $tempResult) {
            RaceQualiResult::create([...$tempResult->toArray(), ...['race_id' => $race->id]]);
            $tempResult->delete();
        }

        activity()
            ->performedOn($race)
            ->withProperties([
                'division' => $race->division->name,
                'track' => $race->track->name,
            ])
            ->log('Quali results uploaded for :properties.division :properties.track');

        return back();
    }

}
