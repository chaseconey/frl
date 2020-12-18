<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaceQualiResults extends Model
{
    use HasFactory;

    protected $fillable = [
        'race_id',
        'driver_id',
        'best_lap_time',
        'best_s1_time',
        'best_s2_time',
        'best_s3_time',
        'lap_delta',
        'best_s1_delta',
        'best_s2_delta',
        'best_s3_delta',
        'speedtrap_speed',
        'best_s1_delta',
    ];

    /**
     * @param  array  $json
     * @return mixed|static
     */
    public static function fromFile(array $json)
    {
        return new static([
            'best_lap_time' => $json['bestLapTime'],
            'best_s1_time' => $json['S1_Time'],
            'best_s2_time' => $json['S2_Time'],
            'best_s3_time' => $json['S3_Time'],
            'lap_delta' => $json['Lap_Delta'],
            'best_s1_delta' => $json['S1_Delta'],
            'best_s2_delta' => $json['S2_Delta'],
            'best_s3_delta' => $json['S3_Delta'],
            'speedtrap_speed' => $json['SpeedTrap'],
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
