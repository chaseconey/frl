@if(!$hasFinishedRace())
    {{ \App\Service\F12020\UdpSpec::RACE_RESULT_STATUS[$result->codemasters_result_status] }}
@else

    @if($result->position === 1)
        {{ $firstResultDisplay($result) }}
    @else

        @if($lapDiff > 0)
            {{-- Show lap delta for lapped results --}}
            + {{ $lapDiff }} {{ \Illuminate\Support\Str::plural('Lap', $lapDiff) }}
        @else
            {{-- Show diff to leader for non-lapped results --}}
            + {{ format_seconds_as_human_time($raceTimeDiff) }}
        @endif

    @endif

@endif
