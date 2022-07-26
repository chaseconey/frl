<?php

namespace App\Models;

use App\Service\F12021\UdpSpec;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Actionable;

/**
 * App\Models\RaceResult
 *
 * @property int $id
 * @property int $race_id
 * @property int $driver_id
 * @property int $grid_position
 * @property int $num_pit_stops
 * @property string $best_lap_time
 * @property int $num_penalties
 * @property float $penalty_seconds
 * @property float $race_time
 * @property string $tire_stints
 * @property int $points
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $f1_team_id
 * @property int $position
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Nova\Actions\ActionEvent[] $actions
 * @property-read int|null $actions_count
 * @property-read \App\Models\Driver $driver
 * @property-read \App\Models\F1Team $f1Team
 * @property-read \App\Models\Race $race
 *
 * @method static \Illuminate\Database\Eloquent\Builder|RaceResult newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RaceResult newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RaceResult query()
 * @method static \Illuminate\Database\Eloquent\Builder|RaceResult whereBestLapTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceResult whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceResult whereDriverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceResult whereF1TeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceResult whereGridPosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceResult whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceResult whereNumPenalties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceResult whereNumPitStops($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceResult wherePenaltySeconds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceResult wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceResult wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceResult whereRaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceResult whereRaceTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceResult whereTireStints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceResult whereUpdatedAt($value)
 * @mixin \Eloquent
 *
 * @property string|null $best_lap_time_legacy
 * @property string|null $race_time_legacy
 * @property int $codemasters_result_status
 * @property int $laps_completed
 * @property-read float $full_race_time
 *
 * @method static \Illuminate\Database\Eloquent\Builder|RaceResult whereBestLapTimeLegacy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceResult whereCodemastersResultStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceResult whereLapsCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceResult whereRaceTimeLegacy($value)
 */
class RaceResult extends Model
{
    use HasFactory, Actionable;

    protected $fillable = [
        'position',
        'grid_position',
        'num_pit_stops',
        'best_lap_time',
        'num_penalties',
        'penalty_seconds',
        'race_time',
        'tire_stints',
        'points',
        'codemasters_result_status',
        'laps_completed',
        'lap_data',
    ];

    protected $casts = [
        'lap_data' => 'array',
    ];

    protected $attributes = [
        'lap_data' => '[]',
    ];

    /**
     * Map in data from file into our model
     */
    public static function fromFile(array $result)
    {
        return new static([
            'position' => $result['m_position'],
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

    public function getFullRaceTimeAttribute(): float
    {
        return $this->race_time + $this->penalty_seconds;
    }
}
