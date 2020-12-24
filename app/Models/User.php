<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Nova\Actions\Actionable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
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
}
