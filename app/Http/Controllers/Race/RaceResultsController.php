<?php

namespace App\Http\Controllers\Race;

use App\Http\Controllers\Controller;
use App\Models\Driver;
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

        return view('races.race-results.index')
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

        DB::transaction(function () use ($results, $race) {
            foreach ($results as $id => $result) {
                // Look up Driver by string name...could be improved to use driver number later possibly.
                $driver = Driver::where('name', $result['Driver'])
                    ->where('division_id', $race->division_id)
                    ->first();

                // TODO: Delete in practice
                if ( ! $driver) {
                    $driver = \App\Models\Driver::factory([
                        'f1_number_id' => $id,
                        'division_id' => $race->division_id,
                        'f1_team_id' => 1,
                        'name' => $result['Driver']
                    ])->create();
                }

                $raceResult = \App\Models\RaceResult::fromFile($result);
                $raceResult->race_id = $race->id;

                $raceResult->driver_id = $driver->id;
                $raceResult->f1_team_id = $driver->f1Team->id;
                $raceResult->position = $id;

                $raceResult->save();
            }
        });

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
