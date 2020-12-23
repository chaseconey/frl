<?php

namespace App\Models;

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

    public function drivers()
    {
        return $this->hasMany(Driver::class);
    }

    public function raceResults()
    {
        return $this->hasMany(RaceResult::class);
    }
}
