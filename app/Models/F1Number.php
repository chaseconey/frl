<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class F1Number extends Model
{
    use HasFactory;

    public function drivers()
    {
        return $this->hasMany(Driver::class, 'f1_number_id');
    }
}
