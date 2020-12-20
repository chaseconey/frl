<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TrackAvatar extends Component
{
    public $track;

    /**
     * Create a new component instance.
     *
     * @param $track
     */
    public function __construct($track)
    {
        $this->track = $track;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.track-avatar');
    }
}
