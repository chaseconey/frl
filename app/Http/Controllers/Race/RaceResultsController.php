<?php

namespace App\Http\Controllers\Race;

use App\Exceptions\ResultsUploadError;
use App\Http\Controllers\Controller;
use App\Models\DriverVideo;
use App\Models\Race;
use App\Models\RaceResult;
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
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Race  $race
     * @param  Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Throwable
     */
    public function store(Race $race, Request $request)
    {
        $request->validate([
            'results' => 'required|mimes:json',
        ]);

        $json = $request->file('results')->getContent();

        $results = json_decode($json, true);

        try {
            $this->uploadResults($results, $race, fn($results) => RaceResult::fromFile($results));
        } catch (ResultsUploadError $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 422);
        }

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
     * @param  RaceResult  $raceResults
     * @return Response
     */
    public function show(RaceResult $raceResults)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  RaceResult  $raceResults
     * @return Response
     */
    public function edit(RaceResult $raceResults)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  RaceResult  $raceResults
     * @return Response
     */
    public function update(Request $request, RaceResult $raceResults)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  RaceResult  $raceResults
     * @return Response
     */
    public function destroy(RaceResult $raceResults)
    {
        //
    }
}
