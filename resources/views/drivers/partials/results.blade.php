<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 dark:border-gray-800 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">
                    <thead class="bg-gray-50 dark:bg-gray-600">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                            Pos
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                            Track
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                            Team
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                            Best Lap
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                            Pit Stops
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                            Tire Strategy
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                            Penalties
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                            Points
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                            Race Time
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-700 divide-y divide-gray-200 dark:divide-gray-800">
                    @foreach($results->sortByDesc('race.race_time') as $result)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">{{ $result->position }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="#">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                        <a href="{{ route('race.results.index', $result->race->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900">
                                            {{ $result->race->track->name }}
                                        </a>
                                    </div>
                                    <div class="text-sm text-gray-500 dark:text-gray-200">
                                        {{ country_code_to_name($result->race->track->country) }}
                                    </div>
                                </a>
                            </td>
                            <td class="px-6 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white pl-2 border-l-4 {{ f1_team_color($result->f1Team->name) }}">
                                    {{ $result->f1Team->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="text-sm text-gray-900 dark:text-white">
                                    @if($result->best_lap_time > 0)
                                        {{ format_seconds_as_human_time($result->best_lap_time) }}
                                    @else
                                        {{ $result->best_lap_time_legacy }}
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">{{ $result->num_pit_stops }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">
                                    @foreach(str_split($result->tire_stints) as $tire)
                                        <x-tire :tire="$tire"></x-tire>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">{{ $result->num_penalties }}
                                    ({{ $result->penalty_seconds }}s)
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="text-sm text-gray-900 dark:text-white">{{ $result->points }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-left">
                                <div class="text-sm text-gray-900 dark:text-white">{{ $result->race->race_time->diffForHumans() }}</div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-5">
                {{ $results->render() }}
            </div>
        </div>
    </div>
</div>
