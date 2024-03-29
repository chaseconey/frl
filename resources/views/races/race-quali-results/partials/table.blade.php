<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 dark:border-gray-800 sm:rounded-lg">
            </div>
            @if($tempResults->count() > 0 && auth()->user() && auth()->user()->can('manage-races'))
                @include('races.partials.temp-results', ['submitRoute' => 'race.quali-results.store', 'deleteRoute' => 'race.temp-quali-results.destroy'])
            @elseif($race->qualiResults->count() === 0 && auth()->user() && auth()->user()->can('manage-races'))
                @include('races.race-results.partials.upload-form', ['route' => 'race.temp-quali-results.store'])
            @else
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">
                    <thead class="bg-gray-50 dark:bg-gray-600">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                            Pos
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                            Driver
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                            Best Lap
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                            Delta
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                            Best Sector Times
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Driver Video</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-700 divide-y divide-gray-200 dark:divide-gray-800">
                    @foreach($race->qualiResults as $result)
                        <x-race-table-row :driver="$result->driver">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">{{ $result->position }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <x-user-avatar :user="$result->driver->user"></x-user-avatar>
                                    </div>
                                    <div class="ml-4">
                                        <a href="{{ route('drivers.show', $result->driver) }}"
                                           class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900">
                                            {{ $result->driver->name }}
                                        </a>
                                        <div class="text-sm text-gray-500 dark:text-gray-200">
                                            {{ $result->f1Team->name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex justify-around">
                                    @if($result->best_lap_tire)
                                        <x-tire :tire="$result->best_lap_tire"></x-tire>
                                    @endif
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        @if($result->best_lap_time_legacy)
                                            {{ $result->best_lap_time_legacy }}
                                        @else
                                            @if($result->best_lap_time > 0)
                                                {{ format_seconds_as_human_time($result->best_lap_time) }}
                                            @else
                                                No Lap
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                @if(!is_null($result->lap_delta))
                                    <div
                                        class="text-sm text-gray-900 dark:text-white">{{ number_format($result->lap_delta, 3) }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">
                                    @if(!is_null($result->best_s1_time))
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $race->quali_results_min_best_s1_time == $result->best_s1_time ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-100' }}">{{ number_format($result->best_s1_time, 3) }}</span>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $race->quali_results_min_best_s2_time == $result->best_s2_time ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-100' }}">{{ number_format($result->best_s2_time, 3) }}</span>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $race->quali_results_min_best_s3_time == $result->best_s3_time ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-100' }}">{{ number_format($result->best_s3_time, 3) }}</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if($driverVideos->has($result->driver_id))
                                    <a href="{{ $driverVideos->get($result->driver_id)->video_url }}"
                                       class="text-red-600 hover:text-red-900" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor" class="w-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                  d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                        </svg>
                                    </a>
                                @endif
                            </td>
                        </x-race-table-row>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
