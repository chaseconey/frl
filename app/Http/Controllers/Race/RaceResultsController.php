<?php

namespace App\Http\Controllers\Race;

use App\Http\Controllers\Controller;
use App\Models\DriverVideo;
use App\Models\Race;
use App\Models\RaceResult;
use App\Traits\RaceResultsParser;
use Illuminate\Http\Request;

class RaceResultsController extends Controller
{
    use RaceResultsParser;

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

        $this->uploadResults($results, $race, fn ($results) => RaceResult::fromFile($results));

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
