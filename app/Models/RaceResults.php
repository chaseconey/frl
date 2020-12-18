<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaceResults extends Model
{
    use HasFactory;

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
            'tire_stints' => $json['TyreStints'],
            'points' => $json['points'],
        ]);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function race()
    {
        return $this->belongsTo(Race::class);
    }
}