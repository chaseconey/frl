<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\DriverVideo
 *
 * @property int $id
 * @property int $race_id
 * @property int $driver_id
 * @property string $video_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Driver $driver
 * @property-read \App\Models\Race $race
 *
 * @method static \Illuminate\Database\Eloquent\Builder|DriverVideo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DriverVideo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DriverVideo query()
 * @method static \Illuminate\Database\Eloquent\Builder|DriverVideo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DriverVideo whereDriverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DriverVideo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DriverVideo whereRaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DriverVideo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DriverVideo whereVideoUrl($value)
 * @mixin \Eloquent
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 *
 * @method static \Database\Factories\DriverVideoFactory factory(...$parameters)
 */
class DriverVideo extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['driver_id', 'race_id', 'video_url'];

    protected static $recordEvents = ['created'];

    public function tapActivity(Activity $activity, string $eventName)
    {
        $track = $this->race->track->name;

        $activity->description = "New driver pov uploaded for {$track}";
    }

    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
