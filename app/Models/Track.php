<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Track extends Model
{
    use HasFactory, Sortable;

    public $sortable = [
        'id',
        'name'
    ];

    public function races()
    {
        return $this->hasMany(Race::class);
    }
}
