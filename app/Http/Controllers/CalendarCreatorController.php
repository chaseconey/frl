<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Track;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarCreatorController extends Controller
{
    public function index()
    {
        $tracks = Track::active()->inRandomOrder()->get();
        $openDivs = Division::active()->get();

        return view('calendar-creator.index')
            ->withTracks($tracks)
            ->withDivisions($openDivs);
    }

    public function store(Request $request)
    {
        $division = Division::findOrFail($request->get('division_id'));

        $timezone = $request->input('form-timezone', 'UTC');
        $races = $request->get('race');

        $races = collect($races)
            ->map(fn ($race) => ['track_id' => $race['track_id'], 'race_time' => (new Carbon($race['race_time'], $timezone))->utc()]);

        $division->races()
            ->createMany($races);

        $request->session()->flash('notice', 'Races have been added to calendar.');

        return redirect()->back();
    }
}
