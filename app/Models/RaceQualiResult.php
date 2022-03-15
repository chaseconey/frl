<?php

namespace App\Models;

use App\Service\F12020\UdpSpec;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Laravel\Nova\Actions\Actionable;

/**
 * App\Models\RaceQualiResult
 *
 * @property int $id
 * @property int $race_id
 * @property int $driver_id
 * @property string $best_lap_time
 * @property float|null $best_s1_time
 * @property float|null $best_s2_time
 * @property float|null $best_s3_time
 * @property float|null $lap_delta
 * @property float|null $best_s1_delta
 * @property float|null $best_s2_delta
 * @property float|null $best_s3_delta
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $f1_team_id
 * @property int $position
 * @property string|null $best_lap_tire
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Nova\Actions\ActionEvent[] $actions
 * @property-read int|null $actions_count
 * @property-read \App\Models\Driver $driver
 * @property-read \App\Models\F1Team $f1Team
 * @property-read \App\Models\Race $race
 * @method static \Illuminate\Database\Eloquent\Builder|RaceQualiResult newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RaceQualiResult newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RaceQualiResult query()
 * @method static \Illuminate\Database\Eloquent\Builder|RaceQualiResult whereBestLapTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceQualiResult whereBestLapTire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceQualiResult whereBestS1Delta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceQualiResult whereBestS1Time($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceQualiResult whereBestS2Delta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceQualiResult whereBestS2Time($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceQualiResult whereBestS3Delta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceQualiResult whereBestS3Time($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceQualiResult whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceQualiResult whereDriverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceQualiResult whereF1TeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceQualiResult whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceQualiResult whereLapDelta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceQualiResult wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceQualiResult whereRaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceQualiResult whereSpeedtrapSpeed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceQualiResult whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $best_lap_time_legacy
 * @property int $codemasters_result_status
 * @method static \Illuminate\Database\Eloquent\Builder|RaceQualiResult whereBestLapTimeLegacy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceQualiResult whereCodemastersResultStatus($value)
 */
class RaceQualiResult extends Model
{
    use HasFactory, Actionable;

    protected $fillable = [
        'race_id',
        'position',
        'driver_id',
        'best_lap_time',
        'best_s1_time',
        'best_s2_time',
        'best_s3_time',
        'lap_delta',
        'best_s1_delta',
        'best_s2_delta',
        'best_s3_delta',
        'best_lap_tire',
        'codemasters_result_status'
    ];

    /**
     * @param  array  $json
     * @return mixed|static
     */
    public static function fromFile(array $raceData, array $allResults)
    {
        // TODO: Pull tire out of m_tyreStintsHistoryData
        $bestLapTire = 17; // fake

        if ($raceData['m_bestLapTimeInMS'] === 0) {
            return new static([
                'position' => $raceData['m_position'],
                'best_lap_time' => 0,
                'codemasters_result_status' => $raceData['m_resultStatus'],
            ]);
        }

        // Grab best lap
        $bestLapNum = $raceData['m_bestLapTimeLapNum'];
        $bestLap = $raceData['m_lapHistoryData'][$bestLapNum - 1];

        // Grab session best
        $sessionBestDriver = collect($allResults['driverData'])->firstWhere('m_position', '=', 1);
        $sessionBestLapNum = $sessionBestDriver['m_bestLapTimeLapNum'];
        $sessionBestLap = $sessionBestDriver['m_lapHistoryData'][$sessionBestLapNum - 1];

        return new static([
            'position' => $raceData['m_position'],
            'best_lap_time' => round($bestLap['m_lapTimeInMS'] / 1000, 3),
            'best_s1_time' => round($bestLap['m_sector1TimeInMS'] / 1000, 3),
            'best_s2_time' => round($bestLap['m_sector2TimeInMS'] / 1000, 3),
            'best_s3_time' => round($bestLap['m_sector3TimeInMS'] / 1000, 3),
            'lap_delta' => static::diffFromSessionBest($bestLap['m_lapTimeInMS'], $sessionBestLap['m_lapTimeInMS']),
            'best_s1_delta' => static::diffFromSessionBest($bestLap['m_sector1TimeInMS'], $sessionBestLap['m_sector1TimeInMS']),
            'best_s2_delta' => static::diffFromSessionBest($bestLap['m_sector2TimeInMS'], $sessionBestLap['m_sector2TimeInMS']),
            'best_s3_delta' => static::diffFromSessionBest($bestLap['m_sector3TimeInMS'], $sessionBestLap['m_sector3TimeInMS']),
            'best_lap_tire' => $bestLapTire ? UdpSpec::TIRES_VISUAL[$bestLapTire] : null,
            'codemasters_result_status' => $raceData['m_resultStatus'],
        ]);
    }

    protected static function diffFromSessionBest($best, $sessionBest) {
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
