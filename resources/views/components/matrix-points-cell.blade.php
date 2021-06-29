<td class="px-2 py-2 whitespace-nowrap border dark:border-gray-900 text-center {{ $pointsColor() }}">
    <div class="text-sm text-gray-900 dark:text-white {{ $isPolePosition() ? 'font-bold' : '' }} {{ $isFastestLap() ? 'italic' : '' }}">
        <a href="{{ route('race.results.index', $race->id) }}">
            {{ $points() }}
        </a>
    </div>
</td>
