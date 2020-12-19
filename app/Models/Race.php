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

    public function scopeCompleted($query)
    {
        return $query->whereDate('race_time', '<=', now()->toDateString());
    }

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
        return $this->hasMany(RaceResults::class)
            ->orderByDesc('points');
    }

    public function qualiResults()
    {
        return $this->hasMany(RaceQualiResults::class)
            ->orderBy('lap_delta');
    }
}
