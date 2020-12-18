<?php

namespace App\Http\Controllers\Race;

use App\Http\Controllers\Controller;
use App\Models\Race;
use App\Models\RaceResults;
use Illuminate\Http\Request;

class RaceResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Race $race)
    {
        $race->load(['results']);

        return view('race-results.index')
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
                ->where('division_id', 1)
                ->first();

            // Delete in practice
            if ( ! $driver) {
                $driver = \App\Models\Driver::factory(['f1_number_id' => $id])->forUser([
                    'name' => $result['Driver']
                ])->create();
            }

            $qualiResult = \App\Models\RaceResults::fromFile($result);
            $qualiResult->race_id = $race->id;

            $qualiResult->driver_id = $driver->id;

            $qualiResult->save();
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RaceResults  $raceResults
     * @return \Illuminate\Http\Response
     */
    public function show(RaceResults $raceResults)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RaceResults  $raceResults
     * @return \Illuminate\Http\Response
     */
    public function edit(RaceResults $raceResults)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RaceResults  $raceResults
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RaceResults $raceResults)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RaceResults  $raceResults
     * @return \Illuminate\Http\Response
     */
    public function destroy(RaceResults $raceResults)
    {
        //
    }
}
