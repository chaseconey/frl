<?php

namespace App\Http\Controllers;

use App\Http\Requests\DriverVideoRequest;
use App\Models\DriverVideo;

class DriverVideoController extends Controller
{
    public function store(DriverVideoRequest $request)
    {
        DriverVideo::updateOrCreate(
            ['driver_id' => $request->driver_id, 'race_id' => $request->race_id],
            $request->all()
        );

        return redirect()->back();
    }
}
