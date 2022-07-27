<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

/**
 * App\Models\Track
 *
 * @property int $id
 * @property string $name
 * @property string $country
 * @property string|null $image_link
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $avatar
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Race[] $races
 * @property-read int|null $races_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Track newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Track newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Track query()
 * @method static \Illuminate\Database\Eloquent\Builder|Track sortable($defaultParameters = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Track whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Track whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Track whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Track whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Track whereImageLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Track whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Track whereUpdatedAt($value)
 * @mixin \Eloquent
 *
 * @method static \Database\Factories\TrackFactory factory(...$parameters)
 */
class Track extends Model
{
    use HasFactory, Sortable;

    public $sortable = [
        'id',
        'name',
    ];

    public function scopeActive(Builder $query)
    {
        return $query->where('is_available', true);
    }

    public function races()
    {
        return $this->hasMany(Race::class);
    }
}
