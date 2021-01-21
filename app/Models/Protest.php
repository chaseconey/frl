<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Protest extends Model
{
    use HasFactory;

    protected $fillable = [
        "driver_id",
        "protested_driver_id",
        "race_id",
        "video_url",
        "description",
        "rules_breached"
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function protestedDriver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function race()
    {
        return $this->belongsTo(Race::class);
    }
}
