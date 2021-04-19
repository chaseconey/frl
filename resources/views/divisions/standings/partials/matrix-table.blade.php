<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Pos
                        </th>
                        <th scope="col"
                            class="px-6 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Driver
                        </th>
                        @foreach($races as $race)
                        <th scope="col"
                            class="px-2 py-2 text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <a href="{{ route('race.results.index', $race->id) }}">
                                {{ $race->track->country }}
                            </a>
                        </th>
                        @endforeach
                        <th scope="col"
                            class="px-6 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Points
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($standings as $driver)
                        <x-race-table-row :driver="$driver">
                            <td class="px-6 py-2 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $loop->iteration }}</div>
                            </td>
                            <td class="px-6 py-2 whitespace-nowrap border-l-2 {{ f1_team_color($driver->f1Team->name) }}">
                                <a href="{{ route('drivers.show', $driver) }}"
                                   class="text-sm text-indigo-600 hover:text-indigo-900">
                                    {{ $driver->name }} <span class="text-xs text-gray-700">#{{ $driver->f1Number->racing_number }}</span>
                                </a>
                            </td>
                            @foreach($races as $race)
                                <x-matrix-points-cell :race="$race" :driver="$driver"></x-matrix-points-cell>
                            @endforeach
                            <td class="px-6 py-2 whitespace-nowrap text-right">
                                <div class="text-sm text-gray-900">{{ $driver->race_results_sum_points ?? 0 }}</div>
                            </td>
                        </x-race-table-row>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
