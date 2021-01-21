<?php

namespace App\Http\Controllers;

use App\Models\Protest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function protests(Request $request)
    {
        $myDrivers = $request->user()->drivers->pluck('id');
        $protests = Protest::whereIn('driver_id', $myDrivers)
            ->latest()
            ->paginate(5);

        return view('profile.protests')
            ->withProtests($protests);
    }
}
