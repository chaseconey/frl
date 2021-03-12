<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
 * @property float|null $speedtrap_speed
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
 */
class RaceQualiResult extends Model
{
    use HasFactory, Actionable;

    protected $fillable = [
        'race_id',
        'driver_id',
        'best_lap_time',
        'best_s1_time',
        'best_s2_time',
        'best_s3_time',
        'lap_delta',
        'best_s1_delta',
        'best_s2_delta',
        'best_s3_delta',
        'speedtrap_speed',
        'best_lap_tire',
    ];

    /**
     * @param  array  $json
     * @return mixed|static
     */
    public static function fromFile(array $json)
    {
        return new static([
            'best_lap_time' => is_null($json['bestLapTime']) ? 'No Lap' : $json['bestLapTime'],
            'best_s1_time' => $json['S1_Time'],
            'best_s2_time' => $json['S2_Time'],
            'best_s3_time' => $json['S3_Time'],
            'lap_delta' => $json['Lap_Delta'],
            'best_s1_delta' => $json['S1_Delta'],
            'best_s2_delta' => $json['S2_Delta'],
            'best_s3_delta' => $json['S3_Delta'],
            'speedtrap_speed' => $json['SpeedTrap'],
            'best_lap_tire' => $json['Tyre']
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
