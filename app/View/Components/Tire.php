<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Tire extends Component
{
    /**
     * @var string
     */
    public $tire;

    /**
     * Create a new component instance.
     *
     * @param  string  $tire
     */
    public function __construct($tire = 'S')
    {
        $this->tire = $tire;
    }

    public function colorFromSize()
    {
        switch (true) {
            case $this->tire == 'S':
                return 'bg-red-500';
                break;
            case $this->tire == 'M':
                return 'bg-yellow-300';
                break;
            case $this->tire == 'H':
                return 'bg-white';
                break;
            case $this->tire == 'I':
                return 'bg-green-600';
                break;
            case $this->tire == 'W':
                return 'bg-blue-500';
                break;
            default:
                return 'bg-white';
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.tire');
    }
}
