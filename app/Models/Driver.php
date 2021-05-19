<?php

namespace App\Models;

use App\Enums\DriverEquipment;
use BenSampo\Enum\Traits\CastsEnums;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Actionable;

/**
 * App\Models\Driver
 *
 * @property int $id
 * @property int|null $user_id
 * @property int $f1_number_id
 * @property int $f1_team_id
 * @property int $division_id
 * @property string $type
 * @property string|null $approved_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property int $steam_friend_code
 * @property string|null $equipment
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Nova\Actions\ActionEvent[] $actions
 * @property-read int|null $actions_count
 * @property-read \App\Models\Division $division
 * @property-read \App\Models\F1Number $f1Number
 * @property-read \App\Models\F1Team $f1Team
 * @property-read \App\Models\RaceResult|null $latestRace
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RaceResult[] $raceResults
 * @property-read int|null $race_results_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Driver newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Driver newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Driver query()
 * @method static \Illuminate\Database\Eloquent\Builder|Driver whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Driver whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Driver whereDivisionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Driver whereEquipment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Driver whereF1NumberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Driver whereF1TeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Driver whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Driver whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Driver whereSteamFriendCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Driver whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Driver whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Driver whereUserId($value)
 * @mixin \Eloquent
 */
class Driver extends Model
{
    use HasFactory, Actionable, CastsEnums;

    protected $fillable = [
        'user_id',
        'f1_number_id',
        'f1_team_id',
        'division_id',
        'type',
        'name',
        'steam_friend_code',
        'equipment'
    ];

    protected $casts = [
        'equipment' => DriverEquipment::class
    ];

    const TYPES = ['FULL_TIME' => 'Full Time', 'RESERVE' => 'Reserve', 'RETIRED' => 'Retired', 'BANNED' => 'Banned'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function f1Number()
    {
        return $this->belongsTo(F1Number::class);
    }

    public function f1Team()
    {
        return $this->belongsTo(F1Team::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function raceResults()
    {
        return $this->hasMany(RaceResult::class);
    }

    public function qualiResults()
    {
        return $this->hasMany(RaceQualiResult::class);
    }

    public function latestRace()
    {
        return $this->hasOne(RaceResult::class)->latestOfMany();
    }
}
