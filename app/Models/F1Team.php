<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class F1Team extends Model
{
    use HasFactory;

    public function drivers()
    {
        return $this->hasMany(Driver::class);
    }

    public function raceResults()
    {
        return $this->hasMany(RaceResults::class);
    }
}
