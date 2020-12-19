<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Driver;
use App\Models\F1Number;
use App\Models\Signup;
use App\Models\F1Team;
use Illuminate\Http\Request;

class SignupController extends Controller
{

    public function index()
    {
        $divisions = Division::withCount('drivers')
            ->get();

        return view('signup.index')
            ->withDivisions($divisions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $division = Division::whereId($request->division_id)
            ->with('drivers', 'drivers.f1Number', 'drivers.f1Team')
            ->first();

        $teams = F1Team::all();

        // TODO: remove already selected numbers
        $takenNumbers = $division->drivers->pluck('f1Number.id');
        $numbers = F1Number::whereNotIn('id', $takenNumbers)->pluck('racing_number', 'id');

        return view('signup.create')
            ->withNumbers($numbers)
            ->withTeams($teams)
            ->withDivision($division);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // TODO: add request

        // TODO: make sure only 2 FULL_TIME drivers per team

        // TODO: make sure a user can only sign up per division 1 time

        // TODO: move to action class
        Driver::create([
            'division_id' => $request->division_id,
            'user_id' => $request->user()->id,
            'f1_number_id' => $request->f1_number_id,
            'f1_team_id' => $request->f1_team_id,
            'type' => $request->type
        ]);

        return redirect()->route('dashboard');
    }

}
