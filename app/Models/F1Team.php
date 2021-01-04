<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class F1Team extends Model
{
    use HasFactory, Sortable;

    public $sortable = [
        'id',
        'name'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'inactive_at' => 'datetime',
    ];

    public function scopeActive(Builder $query)
    {
        return $query->whereNull('inactive_at')
            ->orWhereDate('inactive_at', '>', now());
    }

    public function drivers()
    {
        return $this->hasMany(Driver::class);
    }

    public function raceResults()
    {
        return $this->hasMany(RaceResult::class);
    }
}
