<?php

namespace App\View\Components;

use App\Models\Driver;
use App\Models\Race;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class MatrixPointsCell extends Component
{
    /**
     * @var Driver
     */
    public $driver;

    /**
     * @var Race
     */
    public $race;

    /**
     * @var Collection
     */
    public $driverRaces;

    /**
     * Create a new component instance.
     *
     * @param $driver
     * @param $race
     */
    public function __construct($driver, $race)
    {
        $this->driver = $driver;
        $this->race = $race;
        $this->driverRaces = $driver->raceResults->groupBy('race_id');
    }

    public function points()
    {
        if (isset($this->driverRaces[$this->race->id])) {
            return $this->driverRaces[$this->race->id]->first()->points;
        }

        return '-';
    }

    public function pointsColor()
    {
        switch (true) {
            // 1st
            case $this->points() >= 25:
                return 'bg-yellow-200 dark:bg-yellow-500';

            // 2nd
            case $this->points() >= 18:
                return 'bg-gray-300 dark:bg-gray-400';

            // 3rd
            case $this->points() >= 15:
                return 'bg-yellow-500 bg-opacity-50';

            // In the points
            case $this->points() > 0:
                return 'bg-green-100 dark:bg-green-500';

            // Finished, but out of the points
            case $this->points() === 0:
                return 'bg-indigo-100 dark:bg-gray-500';

            default:
                return 'bg-white bg-gray-700';
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.matrix-points-cell');
    }
}
