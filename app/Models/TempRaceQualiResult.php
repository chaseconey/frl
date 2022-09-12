<?php

namespace App\Models;

use App\Exceptions\UdpDataException;
use App\Service\F122\UdpSpec;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempRaceQualiResult extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * @param  array  $json
     * @return mixed|static
     */
    public static function fromFile(array $result, array $allResults)
    {
        if ($result['m_bestLapTimeInMS'] === 0) {
            return new static([
                'position' => $result['m_position'],
                'racing_number' => $result['m_raceNumber'],
                'name' => $result['m_name'],
                'best_lap_time' => 0,
                'codemasters_result_status' => $result['m_resultStatus'],
            ]);
        }

        try {
            $bestLapTire = UdpSpec::getFastestLapTire($result);
        } catch (UdpDataException $e) {
            // We will just gracefully fail on this one...
            \Log::warning($e->getMessage());
            $bestLapTire = 'S';
        }

        // Grab best lap
        $bestLapNum = $result['m_bestLapTimeLapNum'];
        $bestLap = $result['m_lapHistoryData'][$bestLapNum - 1];

        // Grab session best
        $sessionBestDriver = collect($allResults['driverData'])->firstWhere('m_position', '=', 1);
        $sessionBestLapNum = $sessionBestDriver['m_bestLapTimeLapNum'];
        $sessionBestLap = $sessionBestDriver['m_lapHistoryData'][$sessionBestLapNum - 1];

        return new static([
            'position' => $result['m_position'],
            'racing_number' => $result['m_raceNumber'],
            'name' => $result['m_name'],
            'best_lap_time' => round($bestLap['m_lapTimeInMS'] / 1000, 3),
            'best_s1_time' => round($bestLap['m_sector1TimeInMS'] / 1000, 3),
            'best_s2_time' => round($bestLap['m_sector2TimeInMS'] / 1000, 3),
            'best_s3_time' => round($bestLap['m_sector3TimeInMS'] / 1000, 3),
            'lap_delta' => static::diffFromSessionBest($bestLap['m_lapTimeInMS'], $sessionBestLap['m_lapTimeInMS']),
            'best_s1_delta' => static::diffFromSessionBest($bestLap['m_sector1TimeInMS'], $sessionBestLap['m_sector1TimeInMS']),
            'best_s2_delta' => static::diffFromSessionBest($bestLap['m_sector2TimeInMS'], $sessionBestLap['m_sector2TimeInMS']),
            'best_s3_delta' => static::diffFromSessionBest($bestLap['m_sector3TimeInMS'], $sessionBestLap['m_sector3TimeInMS']),
            'best_lap_tire' => $bestLapTire,
            'codemasters_result_status' => $result['m_resultStatus'],
        ]);
    }

    protected static function diffFromSessionBest($best, $sessionBest)
    {
        return round(($best - $sessionBest) / 1000, 3);
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
