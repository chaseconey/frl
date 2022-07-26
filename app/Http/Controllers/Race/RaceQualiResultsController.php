<?php

namespace App\Http\Controllers\Race;

use App\Exceptions\ResultsUploadError;
use App\Http\Controllers\Controller;
use App\Models\DriverVideo;
use App\Models\Race;
use App\Models\RaceQualiResult;
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
     * @param  Request  $request
     * @return Response
     */
    public function store(Race $race, Request $request)
    {
        $request->validate([
            'results' => 'required|mimes:json',
        ]);

        $json = $request->file('results')->getContent();

        $results = json_decode($json, true);

        try {
            $this->uploadResults($results, $race, fn ($result) => RaceQualiResult::fromFile($result, $results));
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
            ->log('Quali results uploaded for :properties.division :properties.track');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  RaceQualiResult  $raceQualiResults
     * @return \Illuminate\Http\Response
     */
    public function show(RaceQualiResult $raceQualiResults)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  RaceQualiResult  $raceQualiResults
     * @return \Illuminate\Http\Response
     */
    public function edit(RaceQualiResult $raceQualiResults)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  RaceQualiResult  $raceQualiResults
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RaceQualiResult $raceQualiResults)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  RaceQualiResult  $raceQualiResults
     * @return \Illuminate\Http\Response
     */
    public function destroy(RaceQualiResult $raceQualiResults)
    {
        //
    }
}
