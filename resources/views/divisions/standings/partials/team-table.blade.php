<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 dark:border-gray-800 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">
                    <thead class="bg-gray-50 dark:bg-gray-600">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                            Team
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                            Points
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-700 divide-y divide-gray-200 dark:divide-gray-800">
                    @foreach($standings as $team)
                        <tr class="{{ auth()->user() && auth()->user()->hasF1Team($team->id, $division->id) ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="pl-4 border-l-4 {{ f1_team_color($team->name) }}">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $team->name }}
                                    </div>
                                    <div class="text-sm text-gray-500 dark:text-gray-200">
                                        {{ $team->raceResults->pluck('driver.name')->unique()->join(', ') }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div
                                    class="text-sm text-gray-900 dark:text-white">{{ $team->points ?? 0 }}</div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
