<?php

namespace App\Http\Controllers\Division;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Driver;
use Illuminate\Http\Request;

class StandingController extends Controller
{
    public function index(Division $division)
    {
        // TODO: Divisions need date constraints (season? end time?)
        $standings = Driver::where('division_id', $division->id)
            ->with('user', 'f1Team')
            ->has('raceResults')
            ->withSum('raceResults', 'points')
            ->orderByDesc('race_results_sum_points')
            ->get();

//        return $standings;


        return view('divisions.standings.index')
            ->withStandings($standings);
    }
}
