<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Laravel\Nova\Actions\Actionable;

class Race extends Model
{
    use HasFactory, Sortable, Filterable, Actionable;

    public $sortable = [
        'id',
        'race_time'
    ];

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

    public function broadcastVideos()
    {
        return $this->hasMany(BroadcastVideo::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class)
            ->withTrashed();
    }

    public function results()
    {
        return $this->hasMany(RaceResult::class)
            ->orderBy('position');
    }

    public function qualiResults()
    {
        return $this->hasMany(RaceQualiResult::class)
            ->orderBy('position');
    }

    public function protests()
    {
        return $this->hasMany(Protest::class);
    }

    public function driverVideos()
    {
        return $this->hasMany(DriverVideo::class);
    }
}
