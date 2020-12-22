<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Driver $driver)
    {
        // Toggle user of driver
        if ($driver->user_id) {
            $driver->user_id = null;
        } else {
            $driver->user_id = $request->user()->id;
        }
        $driver->save();

        return redirect()->back();
    }
}
