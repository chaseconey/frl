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
        if ($this->driverHasRace()) {
            return $this->driverRaces[$this->race->id]->first()->points;
        }

        return '-';
    }

    /**
     * Helper to determien if the result for diver's cell held the fastest lap.
     *
     * @return bool
     */
    public function isFastestLap()
    {
        if (isset($this->race->fastestLap)) {
            return $this->race->fastestLap->driver_id === $this->driver->id
                && $this->race->fastestLap->best_lap_time > 0;
        }

        return false;
    }

    /**
     * Helper to determine if the the result for driver's cell qualified on pole.
     *
     * @return bool
     */
    public function isPolePosition()
    {
        if ($this->driverHasRace()) {
            return $this->driverRaces[$this->race->id]->first()->grid_position === 1;
        }

        return false;
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
                return 'bg-white dark:bg-gray-700';
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

    /**
     * @return bool
     */
    private function driverHasRace(): bool
    {
        return isset($this->driverRaces[$this->race->id]);
    }
}
