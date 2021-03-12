<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Notice extends Component
{

    /**
     * @var string
     */
    public $message;

    /**
     * @var string|null
     */
    public $detailLink;

    /**
     * Create a new component instance.
     *
     * @param $message
     * @param $detailLink
     */
    public function __construct($message, $detailLink = null)
    {
        $this->message = $message;
        $this->detailLink = $detailLink;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.notice');
    }
}
