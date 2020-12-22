<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Pos
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Driver
                        </th>
                        @foreach($races as $race)
                        <th scope="col"
                            class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ $race->track->country }}
                        </th>
                        @endforeach
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Points
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($standings as $driver)
                        @php
                            $driverRaces = $driver->raceResults->groupBy('race_id');
                        @endphp
                        <tr class="{{ in_array($driver->id, auth()->user()->drivers->pluck('id')->toArray()) ? 'bg-gray-100' : '' }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $loop->iteration }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <x-user-avatar :user="$driver->user"></x-user-avatar>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $driver->name }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $driver->f1Team->name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            @foreach($races as $race)
                                <td class="px-2 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        @if(!isset($driverRaces[$race->id]))
                                            -
                                        @else
                                            {{ $driverRaces[$race->id]->first()->points }}
                                        @endif
                                    </div>
                                </td>
                            @endforeach
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="text-sm text-gray-900">{{ $driver->race_results_sum_points ?? 0 }}</div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
