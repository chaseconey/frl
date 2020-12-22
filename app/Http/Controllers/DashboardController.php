<?php

namespace App\Http\Controllers;

use App\Models\Race;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $latestRaces = Race::latest()
            ->take(5)
            ->with('track', 'division')
            ->withCount('results')
            ->completed()
            ->latest('race_time')
            ->get();

        $myRaces = Race::latest()
            ->take(5)
            ->withCount('results')
            ->with('track', 'division')
            ->completed()
            ->latest('race_time')
            ->whereHas('results', function ($query) {
                $query->whereIn('driver_id', auth()->user()->drivers->pluck('id'));
            })
            ->get();

        return view('dashboard.index')
            ->withMyRaces($myRaces)
            ->withLatestRaces($latestRaces);
    }
}
