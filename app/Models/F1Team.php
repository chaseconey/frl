<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

/**
 * App\Models\F1Team
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $inactive_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Driver[] $drivers
 * @property-read int|null $drivers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RaceResult[] $raceResults
 * @property-read int|null $race_results_count
 * @method static Builder|F1Team active()
 * @method static Builder|F1Team newModelQuery()
 * @method static Builder|F1Team newQuery()
 * @method static Builder|F1Team query()
 * @method static Builder|F1Team sortable($defaultParameters = null)
 * @method static Builder|F1Team whereCreatedAt($value)
 * @method static Builder|F1Team whereId($value)
 * @method static Builder|F1Team whereInactiveAt($value)
 * @method static Builder|F1Team whereName($value)
 * @method static Builder|F1Team whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $codemasters_id
 * @method static \Database\Factories\F1TeamFactory factory(...$parameters)
 * @method static Builder|F1Team whereCodemastersId($value)
 */
class F1Team extends Model
{
    use HasFactory, Sortable;

    public $sortable = [
        'id',
        'name'
    ];

    protected $fillable = ['name', 'codemasters_id'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'inactive_at' => 'datetime',
    ];

    public function scopeActive(Builder $query)
    {
        return $query->whereNull('inactive_at')
            ->orWhereDate('inactive_at', '>', now());
    }

    public function drivers()
    {
        return $this->hasMany(Driver::class);
    }

    public function raceResults()
    {
        return $this->hasMany(RaceResult::class);
    }
}
