<?php

namespace App\Models;

use App\Events\DivisionCreating;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Division
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $day_of_week
 * @property string $race_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $closed_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Driver[] $drivers
 * @property-read int|null $drivers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Race[] $races
 * @property-read int|null $races_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Division active()
 * @method static \Illuminate\Database\Eloquent\Builder|Division newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Division newQuery()
 * @method static \Illuminate\Database\Query\Builder|Division onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Division query()
 * @method static \Illuminate\Database\Eloquent\Builder|Division whereClosedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Division whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Division whereDayOfWeek($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Division whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Division whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Division whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Division whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Division whereRaceTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Division whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Division withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Division withoutTrashed()
 * @mixin \Eloquent
 *
 * @property string|null $opened_at
 * @property string|null $discord_reminder_channel_id
 * @property string $discord_driver_role_id
 * @property string $discord_reserve_role_id
 *
 * @method static \Database\Factories\DivisionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Division whereDiscordDriverRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Division whereDiscordReminderChannelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Division whereDiscordReserveRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Division whereOpenedAt($value)
 */
class Division extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'day_of_week',
        'race_time',
    ];

    protected $dispatchesEvents = [
        'creating' => DivisionCreating::class,
        // TODO: add updating event for updating discord role
    ];

    protected $casts = [
        'closed_at' => 'datetime',
    ];

    public function scopeActive($query)
    {
        return $query->whereDate('closed_at', '>=', now()->format('Y-m-d H:i:s'))
            ->orWhereNull('closed_at');
    }

    public function drivers()
    {
        return $this->hasMany(Driver::class);
    }

    public function races()
    {
        return $this->hasMany(Race::class);
    }
}
