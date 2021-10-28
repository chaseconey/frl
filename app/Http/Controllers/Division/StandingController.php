<?php

namespace App\Http\Controllers\Division;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Driver;
use App\Models\Race;
use App\Models\F1Team;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class StandingController extends Controller
{

    public function teamStandings(Division $division)
    {
        $standings = F1Team::with([
            'raceResults' => function ($query) use ($division) {
                $query->whereHas('race', function ($query) use ($division) {
                    $query->where('division_id', $division->id);
                })
                    ->with('driver', 'driver.user');
            }
        ])
            ->get()
            ->each(function ($team) {
                $points = $team->raceResults->sum('points');
                $team->points = $points;
            })->sortByDesc('points');

        return view('divisions.standings.team-standings')
            ->withDivision($division)
            ->withStandings($standings);
    }

    public function matrix(Division $division)
    {
        $standings = Driver::where('division_id', $division->id)
            ->where('type', '<>', 'BANNED')
            ->with('user', 'f1Team', 'f1Number', 'raceResults')
            ->has('raceResults')
            ->withSum('raceResults', 'points')
            ->orderByDesc('race_results_sum_points')
            ->get();

        $races = Race::where('division_id', $division->id)
            ->with('track', 'fastestLap')
            ->oldest('race_time')
            ->get();

        return view('divisions.standings.matrix')
            ->withDivision($division)
            ->withRaces($races)
            ->withStandings($standings);
    }

    public function plot(Division $division)
    {

        $drivers = Driver::where('division_id', $division->id)
            ->where('type', '<>', 'BANNED')
            ->with('raceResults:id,race_id,driver_id,points')
            ->has('raceResults')
            ->get();

        $races = Race::where('division_id', $division->id)
            ->has('fastestLap')
            ->oldest('race_time')
            ->get();

        $plot = [];
        foreach ($drivers as $driver) {
            $results = [];

            // Get array with key of race id and value of points for this driver
            $points = $driver->raceResults->pluck('points', 'race_id');

            $total = 0;
            // Iterate through each race that we have raced
            foreach ($races->keyBy('id') as $id => $race) {
                // If the driver raced here, add points to previous point total
                $total += Arr::get($points, $id, 0);

                // Add total to cumulative total of points
                $results[] = $total;
            }

            // Add to data structure for frontend
            $plot[] = [
                'results' => $results,
                'driver' => $driver
            ];
        }

        return view('divisions.standings.plot')
            ->withDivision($division)
            ->withRaces($races)
            ->withPlot($plot);

    }
}
