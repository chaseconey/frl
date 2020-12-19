<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    public function drivers()
    {
        return $this->hasMany(Driver::class);
    }

    public function races()
    {
        return $this->hasMany(Race::class);
    }
}
