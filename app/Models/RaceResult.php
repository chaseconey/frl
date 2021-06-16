<?php

namespace App\Models;

use App\Service\F12020\UdpSpec;
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
 * @property int $penalty_seconds
 * @property string $race_time
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
        'laps_completed'
    ];

    /**
     * @param  array  $json
     * @return mixed|static
     */
    public static function fromFile(array $json)
    {
        // TODO: move to helper
        $raceData = $json['race_data'];

        $totalRaceTime = $raceData['m_totalRaceTime'] + $raceData['m_penaltiesTime'];
        
        return new static([
            'position' => $raceData['m_position'],
            'grid_position' => $raceData['m_gridPosition'],
            'num_pit_stops' => $raceData['m_numPitStops'],
            'best_lap_time' => $raceData['m_bestLapTime'],
            'num_penalties' => $raceData['m_numPenalties'],
            'penalty_seconds' => $raceData['m_penaltiesTime'],
            'race_time' => $totalRaceTime,
            'codemasters_result_status' => $raceData['m_resultStatus'],
            'tire_stints' => UdpSpec::mapTireStint($raceData['m_tyreStintsVisual']),
            'points' => $raceData['m_points'],
            'laps_completed' => $raceData['m_numLaps'],
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
