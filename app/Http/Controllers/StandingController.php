<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;

class StandingController extends Controller
{
    public function index()
    {
        $divisions = Division::all();

        return view('standings.index')
            ->withDivisions($divisions);
    }
}
