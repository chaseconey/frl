<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Race;
use Illuminate\Http\Request;

class RaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $races = Race::whereDate('races.race_time', '<=', now()->addWeeks(4))
            ->with('track', 'division')
            ->sortable(['race_time' => 'desc'])
            ->filter($request->all())
            ->paginate();

        $divisions = Division::latest()
            ->get();

        return view('races.index')
            ->withDivisions($divisions)
            ->withRaces($races);
    }

    /**
     * Display the broadcast for the specified Race.
     *
     * @param  \App\Models\Race  $race
     * @return \Illuminate\Http\Response
     */
    public function broadcast(Race $race)
    {
        $race->load('broadcastVideos');

        return view('races.broadcast')
            ->withRace($race);
    }
}
