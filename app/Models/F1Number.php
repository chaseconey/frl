<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\F1Number
 *
 * @property int $id
 * @property int $racing_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Driver[] $drivers
 * @property-read int|null $drivers_count
 * @method static \Illuminate\Database\Eloquent\Builder|F1Number newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|F1Number newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|F1Number query()
 * @method static \Illuminate\Database\Eloquent\Builder|F1Number whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|F1Number whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|F1Number whereRacingNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|F1Number whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class F1Number extends Model
{
    use HasFactory;

    public function drivers()
    {
        return $this->hasMany(Driver::class, 'f1_number_id');
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('is_user_assignable', true);
    }
}
