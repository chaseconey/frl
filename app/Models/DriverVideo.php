<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
 */
class DriverVideo extends Model
{
    use HasFactory;

    protected $fillable = ['driver_id', 'race_id', 'video_url'];

    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
