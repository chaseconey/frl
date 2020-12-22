<?php

namespace App\Http\Controllers;

use App\Models\Race;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $latestRaces = Race::latest('race_time')
            ->take(5)
            ->with('track', 'division')
            ->withCount('results')
            ->completed()
            ->get();

        $myRaces = Race::latest('race_time')
            ->take(5)
            ->withCount('results')
            ->with('track', 'division')
            ->completed()
            ->whereHas('results', function ($query) {
                $query->whereIn('driver_id', auth()->user()->drivers->pluck('id'));
            })
            ->get();

        return view('dashboard.index')
            ->withMyRaces($myRaces)
            ->withLatestRaces($latestRaces);
    }
}
