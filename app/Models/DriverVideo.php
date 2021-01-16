<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverVideo extends Model
{
    use HasFactory;

    protected $fillable = ['driver_id', 'race_id', 'video_url'];
}
