<?php

namespace App\Http\Controllers\Race;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\DriverVideo;
use App\Models\F1Number;
use App\Models\F1Team;
use App\Models\Race;
use App\Models\RaceQualiResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RaceQualiResultsController extends Controller
{
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

        $driverVideos = DriverVideo::where('race_id', $race->id)
            ->get()
            ->keyBy('driver_id');


        return view('races.race-quali-results.index')
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
            $numbers = F1Number::pluck('id', 'racing_number');
            foreach ($results as $racingNumber => $result) {

                $driver = Driver::where('f1_number_id', $numbers[$racingNumber])
                    ->where('division_id', $race->division_id)
                    ->first();

                $qualiResult = \App\Models\RaceQualiResult::fromFile($result);
                $qualiResult->race_id = $race->id;

                $qualiResult->driver_id = $driver->id;
                $qualiResult->f1_team_id = $teams[$result['driver']['m_teamId']];

                $qualiResult->save();
            }
        });

        activity()
            ->performedOn($race)
            ->withProperties([
                'division' => $race->division->name,
                'track' => $race->track->name,
            ])
            ->log('Quali results uploaded for :properties.division :properties.track');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RaceQualiResult  $raceQualiResults
     * @return \Illuminate\Http\Response
     */
    public function show(RaceQualiResult $raceQualiResults)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RaceQualiResult  $raceQualiResults
     * @return \Illuminate\Http\Response
     */
    public function edit(RaceQualiResult $raceQualiResults)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RaceQualiResult  $raceQualiResults
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RaceQualiResult $raceQualiResults)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RaceQualiResult  $raceQualiResults
     * @return \Illuminate\Http\Response
     */
    public function destroy(RaceQualiResult $raceQualiResults)
    {
        //
    }
}
