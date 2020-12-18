<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use HasFactory;

    protected $casts = [
        'race_time' => 'datetime'
    ];

    public function track()
    {
        return $this->belongsTo(Track::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function results()
    {
        return $this->hasMany(RaceResults::class);
    }

    public function qualiResults()
    {
        return $this->hasMany(RaceQualiResults::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
