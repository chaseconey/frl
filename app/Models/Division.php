<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Division extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'day_of_week',
        'race_time'
    ];

    protected $casts = [
        'closed_at' => 'datetime',
    ];

    public function scopeActive($query)
    {
        return $query->whereDate('closed_at', '>=', now()->toDateString())
            ->orWhereNull('closed_at');
    }

    public function drivers()
    {
        return $this->hasMany(Driver::class);
    }

    public function races()
    {
        return $this->hasMany(Race::class);
    }
}
