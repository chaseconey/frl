<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Actionable;

class Driver extends Model
{
    use HasFactory, Actionable;

    protected $fillable = [
        'user_id',
        'f1_number_id',
        'f1_team_id',
        'division_id',
        'type',
        'name',
        'steam_friend_code'
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

    public function latestRace()
    {
        return $this->hasOne(RaceResult::class)
            ->latest();
    }
}
