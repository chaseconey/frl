<?php

namespace App\Http\Controllers\Api\RaceResults;

use App\Http\Controllers\Controller;
use App\Models\RaceResult;

class LapController extends Controller
{
    public function index(RaceResult $result)
    {
        if (! $result->lap_data) {
            abort(404);
        }

        return $result->lap_data;
    }
}
