<?php

namespace App\View\Components;

use App\Enums\DriverEquipment;
use Illuminate\View\Component;

class EquipmentIcon extends Component
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

    /**
     * @return DriverEquipment|\BenSampo\Enum\Enum
     */
    public function driverEqipment()
    {
        return DriverEquipment::fromValue($this->driver->equipment);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.equipment-icon');
    }
}
