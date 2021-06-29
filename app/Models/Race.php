<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Laravel\Nova\Actions\Actionable;

/**
 * App\Models\Race
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $race_time
 * @property int $track_id
 * @property int $division_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Nova\Actions\ActionEvent[] $actions
 * @property-read int|null $actions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BroadcastVideo[] $broadcastVideos
 * @property-read int|null $broadcast_videos_count
 * @property-read \App\Models\Division $division
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DriverVideo[] $driverVideos
 * @property-read int|null $driver_videos_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Protest[] $protests
 * @property-read int|null $protests_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RaceQualiResult[] $qualiResults
 * @property-read int|null $quali_results_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RaceResult[] $results
 * @property-read int|null $results_count
 * @property-read \App\Models\Track $track
 * @method static \Illuminate\Database\Eloquent\Builder|Race completed()
 * @method static \Illuminate\Database\Eloquent\Builder|Race filter(array $input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Race newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Race newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Race paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Race query()
 * @method static \Illuminate\Database\Eloquent\Builder|Race simplePaginateFilter(?int $perPage = null, ?int $columns = [], ?int $pageName = 'page', ?int $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Race sortable($defaultParameters = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Race whereBeginsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Race whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Race whereDivisionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Race whereEndsWith(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Race whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Race whereLike(string $column, string $value, string $boolean = 'and')
 * @method static \Illuminate\Database\Eloquent\Builder|Race whereRaceTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Race whereTrackId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Race whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Race extends Model
{
    use HasFactory, Sortable, Filterable, Actionable;

    public $sortable = [
        'id',
        'race_time'
    ];

    protected $casts = [
        'race_time' => 'datetime'
    ];

    public function scopeCompleted($query)
    {
        return $query->whereDate('race_time', '<=', now()->toDateString());
    }

    public function track()
    {
        return $this->belongsTo(Track::class);
    }

    public function broadcastVideos()
    {
        return $this->hasMany(BroadcastVideo::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function results()
    {
        return $this->hasMany(RaceResult::class)
            ->orderBy('position');
    }

    public function qualiResults()
    {
        return $this->hasMany(RaceQualiResult::class)
            ->orderBy('position');
    }

    public function fastestLap()
    {
        return $this->hasOne(RaceResult::class)->ofMany('best_lap_time', 'min');
    }

    public function protests()
    {
        return $this->hasMany(Protest::class);
    }

    public function driverVideos()
    {
        return $this->hasMany(DriverVideo::class);
    }
}
