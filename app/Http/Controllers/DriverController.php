<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\RaceQualiResult;
use App\Models\RaceResult;
use Illuminate\Http\Request;
use App\Http\Requests\DriverUpdateRequest;

class DriverController extends Controller
{
    public function show(Driver $driver)
    {
        $driver->loadCount('raceResults')
            ->loadSum('raceResults', 'points')
            ->loadAvg('raceResults', 'position')
            ->loadAvg('raceResults', 'num_penalties');

        $results = RaceResult::where('driver_id', $driver->id)
            ->join('races', 'race_results.race_id', '=', 'races.id')
            ->with('race.track', 'f1Team')
            ->orderByDesc('races.race_time')
            ->paginate(5);

        $positions = RaceResult::where('driver_id', $driver->id)
            ->join('races', 'race_results.race_id', '=', 'races.id')
            ->join('tracks', 'tracks.id', '=', 'races.track_id')
            ->select('race_results.position', 'grid_position', 'tracks.country')
            ->orderBy('races.race_time')
            ->get();

        $sectorDeltas = RaceQualiResult::where('driver_id', $driver->id)
            ->select('race_quali_results.*', 'tracks.country')
            ->join('races', 'race_quali_results.race_id', '=', 'races.id')
            ->join('tracks', 'tracks.id', '=', 'races.track_id')
            ->orderBy('races.race_time')
            ->get();

        return view('drivers.show')
            ->withSectorDeltas($sectorDeltas)
            ->withResults($results)
            ->withPositions($positions)
            ->withDriver($driver);
    }

    public function edit(Driver $driver)
    {
        return view('drivers.edit')
            ->withDriver($driver);
    }

    public function update(DriverUpdateRequest $request, Driver $driver)
    {
        $driver->update($request->only('equipment', 'steam_friend_code'));

        $request->session()->flash('notice', 'Driver has been updated.');

        return redirect()->back();
    }
}
