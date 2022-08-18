<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Nova\Actions\Actionable;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Nova\Actions\ActionEvent[] $actions
 * @property-read int|null $actions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Driver[] $drivers
 * @property-read int|null $drivers_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 *
 * @property string|null $discord_user_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Driver[] $activeDrivers
 * @property-read int|null $active_drivers_count
 *
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDiscordUserId($value)
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles, Actionable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'discord_user_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function drivers()
    {
        return $this->hasMany(Driver::class);
    }

    public function activeDrivers()
    {
        return $this->hasMany(Driver::class)
            ->whereHas('division', function ($query) {
                return $query->active();
            });
    }

    /**
     * Determines if a User is associated with a given Driver
     *
     * @param $driverId
     * @return bool
     */
    public function hasDriver($driverId)
    {
        return $this->drivers->where('id', $driverId)->isNotEmpty();
    }

    /**
     * Does User have a Driver in given division
     *
     * @return bool
     */
    public function hasDriverInDivision($divisionId)
    {
        return $this->drivers->where('division_id', $divisionId)->isNotEmpty();
    }

    /**
     * Determines if a User is associated with a given Team for a specific Division
     *
     * @param $teamId
     * @param $divisionId
     * @return bool
     */
    public function hasF1Team($teamId, $divisionId)
    {
        return $this->drivers->where('division_id', $divisionId)->where('f1_team_id', $teamId)->isNotEmpty();
    }

    /**
     * Get driver for User for specified Division
     *
     * @param $divisionId
     * @return mixed
     */
    public function driverForDivision($divisionId)
    {
        return $this->drivers->where('division_id', $divisionId)->first();
    }

    public function routeNotificationForDiscord()
    {
        return env('DISCORD_PROTEST_CHANNEL_ID');
    }
}
