<?php

namespace App\Http\Controllers\Division;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Driver;
use App\Models\Race;
use App\Models\F1Team;
use Illuminate\Http\Request;

class StandingController extends Controller
{
    public function standings(Division $division)
    {
        $standings = Driver::where('division_id', $division->id)
            ->where('type', '<>', 'BANNED')
            ->with('user', 'f1Team', 'f1Number')
            ->has('raceResults')
            ->withSum('raceResults', 'points')
            ->orderByDesc('race_results_sum_points')
            ->get();


        return view('divisions.standings.standings')
            ->withDivision($division)
            ->withStandings($standings);
    }

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
            ->with('track')
            ->oldest('race_time')
            ->get();


        return view('divisions.standings.matrix')
            ->withDivision($division)
            ->withRaces($races)
            ->withStandings($standings);
    }
}
