<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Driver;
use Illuminate\Support\Str;

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
            ->active()
            ->get();

        return view('divisions.index')
            ->withDivisions($divisions);
    }

    public function export(Division $division)
    {
        $slug = Str::slug($division->name);
        $filename = "{$slug}-map.csv";

        return response()->streamDownload(function () use ($division) {
            $data = Driver::where('division_id', $division->id)
                ->with('f1Number')
                ->get()
                ->pluck('name', 'f1Number.racing_number');

            echo 'number,name'.PHP_EOL;
            $data->each(function ($driver, $number) {
                echo "{$number},{$driver}".PHP_EOL;
            });
        }, $filename);
    }
}
