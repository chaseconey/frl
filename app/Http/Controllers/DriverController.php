<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\RaceResult;
use Illuminate\Http\Request;

class DriverController extends Controller
{

    public function show(Driver $driver)
    {
        $driver->loadCount('raceResults')
            ->loadSum('raceResults', 'points')
            ->loadAvg('raceResults', 'position')
            ->loadAvg('raceResults', 'num_penalties');

        $results = RaceResult::where('driver_id', $driver->id)
            ->with('race.track', 'f1Team')
            ->paginate(5);

        return view('drivers.show')
            ->withResults($results)
            ->withDriver($driver);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Driver $driver)
    {
        // Toggle user of driver
        if ($driver->user_id) {
            $driver->user_id = null;
        } else {
            $driver->user_id = $request->user()->id;
        }
        $driver->save();

        return redirect()->back();
    }
}
