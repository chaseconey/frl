<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $divisions = Division::withCount('drivers')
            ->with(['drivers', 'drivers.user', 'drivers.f1Team', 'drivers.f1Number'])
            ->get();

        return view('divisions.index')
            ->withDivisions($divisions);
    }
}
