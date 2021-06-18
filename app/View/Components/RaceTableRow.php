<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RaceTableRow extends Component
{
    public $driver;

    /**
     * Create a new component instance.
     *
     * @param $driver
     */
    public function __construct($driver)
    {
        $this->driver = $driver;
    }

    public function backgroundColor()
    {
        switch (true) {
            case auth()->user() && auth()->user()->hasDriver($this->driver->id):
                return 'bg-gray-100 dark:bg-gray-800';
            default:
                return '';
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.race-table-row');
    }
}
