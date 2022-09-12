<?php

namespace App\Http\Controllers\Race;

use App\Exceptions\ResultsUploadError;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostTempRaceResultsRequest;
use App\Models\Race;
use App\Models\TempRaceResult;
use App\Traits\RaceResultsParser;
use Illuminate\Http\Request;

class TempRaceResultsController extends Controller
{
    use RaceResultsParser;

    /**
     * Store a newly created resource in storage.
     *
     * @param  Race  $race
     * @param  Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function store(Race $race, PostTempRaceResultsRequest $request)
    {
        $json = $request->file('results')->getContent();

        $results = json_decode($json, true);

        try {
            $this->uploadResults($results, $race, fn ($result) => TempRaceResult::fromFile($result));
        } catch (ResultsUploadError $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 422);
        }

        return redirect()->back();
    }

    public function destroy(Race $race, $id)
    {
        $result = TempRaceResult::findOrFail($id);
        $result->delete();

        return response('', 204);
    }
}
