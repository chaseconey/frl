<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Nova\Actions\Actionable;

class RaceResult extends Model
{
    use HasFactory, Actionable;

    protected $fillable = [
        'grid_position',
        'num_pit_stops',
        'best_lap_time',
        'num_penalties',
        'penalty_seconds',
        'race_time',
        'tire_stints',
        'points'
    ];

    /**
     * @param  array  $json
     * @return mixed|static
     */
    public static function fromFile(array $json)
    {
        return new static([
            'grid_position' => $json['gridPosition'],
            'num_pit_stops' => $json['numPitStops'],
            'best_lap_time' => $json['FastestLap'],
            'num_penalties' => $json['numPenalties'],
            'penalty_seconds' => $json['penaltiesTime'],
            'race_time' => $json['RaceTime'],
            'tire_stints' => Str::of($json['TyreStints'])->trim(),
            'points' => $json['points'],
        ]);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function f1Team()
    {
        return $this->belongsTo(F1Team::class);
    }

    public function race()
    {
        return $this->belongsTo(Race::class);
    }
}
