<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Race;
use Illuminate\Http\Request;

class RaceController extends Controller
{

    public function index(Request $request)
    {

        // ?start=2020-12-01T00:00:00-05:00&end=2021-01-12T00:00:00-05:00
        $races = Race::where('race_time', '<=', $request->get('end'))
            ->where('race_time', '>', $request->get('start'))
            ->with('track', 'division')
            ->get();

//        {
//            "title": "Event 2",
//            "start": "2019-09-08",
//            "end": "2019-09-10"
//        }
        return $races->map(function(Race $r) {
            return [
                'title' => "{$r->track->name} - {$r->division->name}",
                'start' => $r->race_time,
                'end' => $r->race_time->addHours(2),
                'url' => route('race.results.index', $r->id),
                'display' => 'auto'
            ];
        });
    }

}
