<?php

namespace App\Http\Controllers\Race;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\DriverVideo;
use App\Models\F1Number;
use App\Models\F1Team;
use App\Models\Race;
use App\Models\RaceResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RaceResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Race $race)
    {
        $race->load(['results', 'results.driver', 'results.driver.user', 'results.f1Team']);

        $driverVideos = DriverVideo::where('race_id', $race->id)
            ->get()
            ->keyBy('driver_id');

        return view('races.race-results.index')
            ->withDriverVideos($driverVideos)
            ->withRace($race);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Race  $race
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Race $race, Request $request)
    {
        $request->validate([
            'results' => 'required|mimes:json',
        ]);

        $json = $request->file('results')->getContent();

        $results = json_decode($json, true);

        DB::transaction(function () use ($results, $race) {
            $teams = F1Team::pluck('id', 'codemasters_id');
            $numbers = F1Number::pluck('id', 'racing_number')->toArray();
            foreach ($results as $racingNumber => $result) {

                // TODO: use collection methods
                if (array_key_exists($racingNumber, $numbers)) {
                    $driver = Driver::where('f1_number_id', $numbers[$racingNumber])
                        ->where('division_id', $race->division_id)
                        ->first();

                    $raceResult = \App\Models\RaceResult::fromFile($result);
                    $raceResult->race_id = $race->id;

                    $raceResult->driver_id = $driver->id;
                    $raceResult->f1_team_id = $teams[$result['driver']['m_teamId']];

                    $raceResult->save();
                }
            }
        });

        activity()
            ->performedOn($race)
            ->withProperties([
                'division' => $race->division->name,
                'track' => $race->track->name,
            ])
            ->log('Race results uploaded for :properties.division :properties.track');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RaceResult  $raceResults
     * @return \Illuminate\Http\Response
     */
    public function show(RaceResult $raceResults)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RaceResult  $raceResults
     * @return \Illuminate\Http\Response
     */
    public function edit(RaceResult $raceResults)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RaceResult  $raceResults
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RaceResult $raceResults)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RaceResult  $raceResults
     * @return \Illuminate\Http\Response
     */
    public function destroy(RaceResult $raceResults)
    {
        //
    }
}
