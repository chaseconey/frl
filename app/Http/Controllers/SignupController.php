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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = Division::all();
        $teams = F1Team::all();

        // TODO: remove already selected numbers
        $numbers = F1Number::all();

        return view('signup.create')
            ->withNumbers($numbers)
            ->withTeams($teams)
            ->withDivisions($divisions);
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

        // TODO: move to action class
        Driver::create([
            'division_id' => $request->division_id,
            'user_id' => $request->user()->id,
            'f1_number_id' => $request->f1_number_id,
            'f1_team_id' => $request->f1_team_id
        ]);

        return redirect()->route('dashboard');
    }

}
