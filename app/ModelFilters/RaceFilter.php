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

        // Translate full country to shorthand (which is what the DB has)
        $shorthand = array_search($search, config('countries')) ?: $search;

        return $this->whereHas('track', function ($query) use ($shorthand, $search) {
            return $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('country', 'LIKE', "%{$shorthand}%");
        });
    }
}
