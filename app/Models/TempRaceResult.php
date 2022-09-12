<?php

namespace App\Models;

use App\Service\F122\UdpSpec;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempRaceResult extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function fromFile(array $result)
    {
        return new static([
            'position' => $result['m_position'],
            'name' => $result['m_name'],
            'racing_number' => $result['m_raceNumber'],
            'grid_position' => $result['m_gridPosition'],
            'num_pit_stops' => $result['m_numPitStops'],
            'best_lap_time' => $result['m_bestLapTimeInMS'] / 1000,
            'num_penalties' => $result['m_numPenalties'],
            'penalty_seconds' => $result['m_penaltiesTime'],
            'race_time' => $result['m_totalRaceTime'],
            'codemasters_result_status' => $result['m_resultStatus'],
            'tire_stints' => UdpSpec::mapTireStint($result['m_tyreStintsVisual']),
            'points' => $result['m_points'],
            'laps_completed' => $result['m_numLaps'],
            'lap_data' => collect($result['m_lapHistoryData'])->where('m_lapTimeInMS', '>', 0),
        ]);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function f1Team()
    {
        return $this->belongsTo(F1Team::class);
    }

    public function race()
    {
        return $this->belongsTo(Race::class);
    }
}
