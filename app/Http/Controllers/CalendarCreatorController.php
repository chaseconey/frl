<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Track;
use Illuminate\Http\Request;

class CalendarCreatorController extends Controller
{
    public function index()
    {
        $tracks = Track::inRandomOrder()->get();
        $openDivs = Division::active()->get();

        return view('calendar-creator.index')
            ->withTracks($tracks)
            ->withDivisions($openDivs);
    }

    public function store(Request $request)
    {
        $division = Division::findOrFail($request->get('division_id'));

        $division->races()
            ->createMany($request->get('race'));

        $request->session()->flash('notice', 'Races have been added to calendar.');

        return redirect()->back();
    }
}
