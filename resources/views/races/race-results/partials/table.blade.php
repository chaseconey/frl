<div class="flex flex-col" x-data="lapData()">
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
                            Driver
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
                            Race Time
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                            Points
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Driver Video</span>
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Laps</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-700 divide-y divide-gray-200 dark:divide-gray-800">
                    @foreach($race->results as $result)
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
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            <a href="{{ route('drivers.show', $result->driver) }}"
                                               class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900">
                                                {{ $result->driver->name }}
                                            </a>
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-200">
                                            {{ $result->f1Team->name ?? '' }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div
                                    class="text-sm dark:text-white {{ $race->results_min_best_lap_time == $result->best_lap_time ? 'text-purple-800' : 'text-gray-800 dark:text-gray-100' }}">
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
                                <div class="text-sm text-gray-900 dark:text-white">

                                    @if ($result->race_time_legacy)
                                        {{-- This is for preserving old string-based race data --}}
                                        {{ $result->race_time_legacy }}
                                    @else
                                        <x-race-time-column :race="$race" :result="$result"/>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="text-sm text-gray-900 dark:text-white">{{ $result->points }}</div>
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
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if($result->lap_data)
                                <span class="cursor-pointer text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-100" @click="fetchLaps({{ $result->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                                    </svg>
                                </span>
                                @endif
                            </td>
                        </x-race-table-row>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if($race->results->count() === 0 && auth()->user() && auth()->user()->hasRole('admin'))
                @include('races.race-results.partials.upload-form', ['route' => 'race.results.store'])
            @endif
        </div>
    </div>

    @include('races.partials.lap-modal')

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>
<script>
    function lapData () {
        return {
            // other default properties
            isLoading: false,
            laps: [],
            labels: [],
            values: [],
            open: false,
            openRawLaps: false,
            fetchLaps (id) {
                this.isLoading = true
                fetch(`/api/race-results/${id}/laps`)
                    .then(res => res.json())
                    .then(data => {
                        this.isLoading = false;
                        this.laps = data;
                        this.open = true;
                        this.values = this.laps.map(l => l.m_lapTimeInMS / 1000);
                        this.labels = [...Array(this.values.length).keys()].map(a=>a+1);

                    })
            },
            init() {
                let chart = new Chart(this.$refs.canvas.getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: this.labels,
                        datasets: [{
                            data: this.values,
                            backgroundColor: '#77C1D2',
                            borderColor: '#77C1D2',
                        }],
                    },
                    options: {
                        interaction: {intersect: false},
                        scales: {y: {beginAtZero: true}},
                        plugins: {
                            legend: {display: false},
                            tooltip: {
                                displayColors: false,
                            }
                        }
                    }
                })

                this.$watch('values', () => {
                    chart.data.labels = this.labels
                    chart.data.datasets[0].data = this.values
                    chart.update()
                })
            }
        }
    }
</script>



