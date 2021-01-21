<?php

namespace App\Http\Controllers\Race;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\DriverVideo;
use App\Models\F1Team;
use App\Models\Protest;
use App\Models\Race;
use App\Models\RaceResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProtestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Race $race)
    {
        $protests = Protest::where('race_id', $race->id)
            ->paginate(5);


        return view('races.protests')
            ->withProtests($protests)
            ->withRace($race);
    }
}
