<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;

class StandingController extends Controller
{
    public function index(Request $request)
    {
        $divisions = Division::query()
            ->when(!$request->has('show-closed'), function ($query) {
                return $query->active();
            })
            ->latest()
            ->get();

        return view('standings.index')
            ->withDivisions($divisions);
    }
}
