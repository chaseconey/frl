<?php

namespace App\Models;

use App\Notifications\ProtestReviewComplete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Protest
 *
 * @property int $id
 * @property int $race_id
 * @property int $driver_id
 * @property int $protested_driver_id
 * @property string $video_url
 * @property string $rules_breached
 * @property string $description
 * @property string|null $stewards_decision
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Driver $driver
 * @property-read mixed $status
 * @property-read \App\Models\Driver $protestedDriver
 * @property-read \App\Models\Race $race
 * @method static \Illuminate\Database\Eloquent\Builder|Protest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Protest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Protest query()
 * @method static \Illuminate\Database\Eloquent\Builder|Protest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Protest whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Protest whereDriverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Protest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Protest whereProtestedDriverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Protest whereRaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Protest whereRulesBreached($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Protest whereStewardsDecision($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Protest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Protest whereVideoUrl($value)
 * @mixin \Eloquent
 */
class Protest extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        "driver_id",
        "protested_driver_id",
        "race_id",
        "video_url",
        "description",
        "rules_breached"
    ];

    protected static $recordEvents = ['created'];

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->description = "New protest filed by :causer.name";
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::updating(function ($protest) {
            $old = $protest->getOriginal();
            $new = $protest->getDirty();

            // If a decision is made, send notification to driver, but only the first time it is changed.
            if (
                is_null($old['stewards_decision']) &&
                array_key_exists('stewards_decision', $new) &&
                ! is_null($new['stewards_decision'])
            ) {
                /**
                 * @var \App\Models\User $user
                 */
                $user = Driver::find($old['driver_id'])->user;
                if ($user) {
                    $user->notify(new ProtestReviewComplete($protest));
                }
            }
        });
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function protestedDriver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    public function getStatusAttribute()
    {
        return $this->stewards_decision ? 'Complete' : 'In Review';
    }
}
