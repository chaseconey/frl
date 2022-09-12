<?php

namespace App\Http\Controllers\Race;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRaceResultsRequest;
use App\Models\Driver;
use App\Models\DriverVideo;
use App\Models\Race;
use App\Models\RaceResult;
use App\Models\TempRaceResult;
use App\Traits\RaceResultsParser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RaceResultsController extends Controller
{
    use RaceResultsParser;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Race $race)
    {
        $race->load(['results', 'results.driver', 'results.driver.user', 'results.f1Team'])
            ->loadMin('results', 'best_lap_time');

        $tempResults = TempRaceResult::where('race_id', $race->id)->orderBy('position')->get();
        $drivers = Driver::where('division_id', $race->division_id)->get();

        $driverVideos = DriverVideo::where('race_id', $race->id)
            ->get()
            ->keyBy('driver_id');

        return view('races.race-results.index')
            ->withDriverVideos($driverVideos)
            ->withRace($race)
            ->withTempResults($tempResults)
            ->withDrivers($drivers);
    }

    public function store(Race $race, PostRaceResultsRequest $request)
    {

        // Save changes to drivers (and whatever else we allow)
        foreach ($request->input('driver_id', []) as $position => $driverId) {
            $result = TempRaceResult::where('race_id', $race->id)
                ->where('position', $position)
                ->first();

            $result->driver_id = $driverId;
            $result->save();
        }

        // Validate all the things
        $tempResults = TempRaceResult::where('race_id', $race->id)
            ->get();

        try {
            $this->validateTempResults($tempResults);
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }

        // Convert temp results into real results
        foreach ($tempResults as $tempResult) {
            RaceResult::create([...$tempResult->toArray(), ...['race_id' => $race->id]]);
            $tempResult->delete();
        }

        activity()
            ->performedOn($race)
            ->withProperties([
                'division' => $race->division->name,
                'track' => $race->track->name,
            ])
            ->log('Race results uploaded for :properties.division :properties.track');

        return back();
    }
}
