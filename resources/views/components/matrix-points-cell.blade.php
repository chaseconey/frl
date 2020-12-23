<td class="px-2 py-2 whitespace-nowrap border text-center {{ $pointsColor() }}">
    <div class="text-sm text-gray-900">
        <a href="{{ route('race.results.index', $race->id) }}">
            {{ $points() }}
        </a>
    </div>
</td>
