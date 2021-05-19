<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class RaceFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function division($id)
    {
        return $this->where('division_id', $id);
    }

    public function search($search)
    {
        return $this->whereHas('track', function($query) use ($search)
        {
            return $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('country', 'LIKE', "%{$search}%");
        });
    }
}
