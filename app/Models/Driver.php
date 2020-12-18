<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'f1_number_id',
        'f1_team_id',
        'division_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'approved_at' => 'datetime',
    ];

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

    public function races()
    {
        return $this->hasMany(Race::class);
    }
}
