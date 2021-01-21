<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProtestRequest;
use App\Models\Division;
use App\Models\Driver;
use App\Models\Protest;
use App\Models\Race;
use App\Models\User;
use App\Notifications\ProtestSubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ProtestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $division = Division::findOrFail($request->division_id);

        $races = Race::where('division_id', $division->id)
            ->with('track')
            ->completed()
            ->get();

        $drivers = Driver::where('division_id', $division->id)->orderBy('name')->get();

        return view('protests.create')
            ->withRaces($races)
            ->withDrivers($drivers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProtestRequest  $request
     * @return ProtestRequest|Request
     */
    public function store(ProtestRequest $request)
    {
        $protest = Protest::create($request->all());

        $users = User::permission('manage-protests')->get();
        Notification::send($users, new ProtestSubmitted($protest));

        return redirect()->route('profile.protests');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Protest  $protest
     * @return \Illuminate\Http\Response
     */
    public function show(Protest $protest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Protest  $protest
     * @return \Illuminate\Http\Response
     */
    public function edit(Protest $protest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Protest  $protest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Protest $protest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Protest  $protest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Protest $protest)
    {
        //
    }
}
