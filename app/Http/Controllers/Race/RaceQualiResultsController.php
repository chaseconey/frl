<?php

namespace App\Http\Controllers\Race;

use App\Http\Controllers\Controller;
use App\Models\Race;
use App\Models\RaceQualiResults;
use Illuminate\Http\Request;

class RaceQualiResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Race $race)
    {
        $race->load(['qualiResults'])
            ->loadMin('qualiResults', 'best_s1_time')
            ->loadMin('qualiResults', 'best_s2_time')
            ->loadMin('qualiResults', 'best_s3_time')
            ->loadMax('qualiResults', 'speedtrap_speed');


        return view('races.race-quali-results.index')
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

        $parser = new \App\Service\RaceParser();
        $results = $parser->parse($json);

        foreach ($results as $id => $result) {
            // Look up Driver by string name...could be improved to use driver number later possibly.
            $driver = \App\Models\User::join('drivers', 'drivers.user_id', '=', 'users.id')
                ->select('drivers.id')
                ->whereName($result['Driver'])
                ->where('division_id', $race->division_id)
                ->first();

            // TODO: Delete in practice
            if ( ! $driver) {
                $driver = \App\Models\Driver::factory(['f1_number_id' => $id, 'division_id' => $race->division_id])->forUser([
                    'name' => $result['Driver']
                ])->create();
            }

            $qualiResult = \App\Models\RaceQualiResults::fromFile($result);
            $qualiResult->race_id = $race->id;

            $qualiResult->driver_id = $driver->id;

            $qualiResult->save();
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RaceQualiResults  $raceQualiResults
     * @return \Illuminate\Http\Response
     */
    public function show(RaceQualiResults $raceQualiResults)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RaceQualiResults  $raceQualiResults
     * @return \Illuminate\Http\Response
     */
    public function edit(RaceQualiResults $raceQualiResults)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RaceQualiResults  $raceQualiResults
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RaceQualiResults $raceQualiResults)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RaceQualiResults  $raceQualiResults
     * @return \Illuminate\Http\Response
     */
    public function destroy(RaceQualiResults $raceQualiResults)
    {
        //
    }
}
