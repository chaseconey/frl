<?php

namespace App\View\Components;

use App\Models\Race;
use App\Models\RaceResult;
use Illuminate\View\Component;

class RaceTimeColumn extends Component
{
    public Race $race;
    public RaceResult $result;
    public int $lapDiff;
    public float $raceTimeDiff;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Race $race, RaceResult $result)
    {
        $this->race = $race;
        $this->result = $result;

        $this->lapDiff = $this->getLapDiff();
        $this->raceTimeDiff = $this->getRaceTimeDiff();
    }

    public function hasFinishedRace(): bool
    {
        return \App\Service\F12020\UdpSpec::isRaceResultStatusFinished($this->result->codemasters_result_status);
    }

    public function firstResultDisplay($result)
    {
        return format_seconds_as_human_time($result->race_time);
    }

    public function getRaceTimeDiff(): float
    {
        $firstPlace = $this->race->results[0];
        return $this->result->race_time - $firstPlace->race_time;
    }

    public function getLapDiff(): int
    {
        $firstPlace = $this->race->results[0];
        return $firstPlace->laps_completed - $this->result->laps_completed;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.race-time-column');
    }
}
