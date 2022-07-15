<?php

namespace App\Http\Controllers;

use App\Models\Race;
use App\Models\RaceResult;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function index()
    {
        $lastRace = Race::lastRace();

        $nextRace = Race::nextRace();

        $drivers = auth()->user()->activeDrivers;

        $results = collect();
        if ($drivers->first()) {
            $results = RaceResult::where('driver_id', $drivers->first()->id)
                ->join('races', 'race_results.race_id', '=', 'races.id')
                ->with('race.track', 'f1Team')
                ->orderByDesc('races.race_time')
                ->paginate(5);
        }

        $feed = Activity::latest()->take(10)->get();

        return view('dashboard.index')
            ->withResults($results)
            ->withLastRace($lastRace)
            ->withNextRace($nextRace)
            ->withFeed($feed);
    }
}
