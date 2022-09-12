<?php

namespace App\Models;

use App\Exceptions\UdpDataException;
use App\Service\F122\UdpSpec;
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
 *
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
 *
 * @property string|null $best_lap_time_legacy
 * @property int $codemasters_result_status
 *
 * @method static \Illuminate\Database\Eloquent\Builder|RaceQualiResult whereBestLapTimeLegacy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RaceQualiResult whereCodemastersResultStatus($value)
 */
class RaceQualiResult extends Model
{
    use HasFactory, Actionable;

    protected $fillable = [
        'race_id',
        'position',
        'f1_team_id',
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
        'codemasters_result_status',
    ];

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
