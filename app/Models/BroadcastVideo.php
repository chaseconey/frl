<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\BroadcastVideo
 *
 * @property int $id
 * @property string $video_url
 * @property string $title
 * @property int $race_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Race $race
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BroadcastVideo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BroadcastVideo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BroadcastVideo query()
 * @method static \Illuminate\Database\Eloquent\Builder|BroadcastVideo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BroadcastVideo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BroadcastVideo whereRaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BroadcastVideo whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BroadcastVideo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BroadcastVideo whereVideoUrl($value)
 * @mixin \Eloquent
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 */
class BroadcastVideo extends Model
{
    use HasFactory, LogsActivity;

    protected static $recordEvents = ['created'];

    public function tapActivity(Activity $activity, string $eventName)
    {
        $track = $this->race->track->name;
        $division = $this->race->division->name;

        $activity->description = "Broadcast uploaded for {$division} {$track}";
    }

    public function race()
    {
        return $this->belongsTo(Race::class);
    }
}
