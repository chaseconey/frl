<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
                {{ $driver->name }}
                <span class="text-lg text-gray-600 dark:text-gray-300">#{{ $driver->f1Number->racing_number }}</span>
                <span class="p-4 whitespace-nowrap align-middle" x-data="{ open: false }">
                    <div class="relative inline-block text-left">
                        <div class="z-0">
                            <button @click="open = true"
                                    class="rounded-full flex items-center text-gray-400 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500"
                                    id="options-menu" aria-haspopup="true" aria-expanded="true">
                                <span class="sr-only">Open options</span>
                                <!-- Heroicon name: dots-vertical -->
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path
                                        d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                </svg>
                            </button>
                        </div>

                        <!--
                          Dropdown panel, show/hide based on dropdown state.

                          Entering: "transition ease-out duration-100"
                            From: "transform opacity-0 scale-95"
                            To: "transform opacity-100 scale-100"
                          Leaving: "transition ease-in duration-75"
                            From: "transform opacity-100 scale-100"
                            To: "transform opacity-0 scale-95"
                        -->
                        <div x-show="open"
                             @click.away="open = false"
                             style="display: none;"
                             class="z-50 origin-top-right absolute left-0 mt-2 w-56 rounded-md shadow-lg bg-white dark:bg-gray-700 ring-1 ring-black ring-opacity-5">
                            <div class="py-1 z-10" role="menu" aria-orientation="vertical"
                                 aria-labelledby="options-menu">

                                <span
                                    class="friend-code cursor-pointer block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-gray-100"
                                    data-clipboard-text="{{ $driver->steam_friend_code }}"
                                >
                                    Copy Steam Friend Code
                                </span>

                                @role('admin')
                                <a href="/nova/resources/drivers/{{ $driver->id }}"
                                   target="_blank"
                                   class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-gray-100"
                                   role="menuitem">Manage Driver</a>
                                @endrole
                            </div>
                        </div>
                    </div>
                </span>
            </h2>

            <div class="flex gap-1 items-center">

                <x-equipment-icon :driver="$driver" />

                <button
                    class="friend-code ring-0 focus:outline-none focus:ring-0 text-xl leading-none"
                    data-clipboard-text="{{ $driver->steam_friend_code }}"
                >
                    <i class="fab fa-steam" title="{{ $driver->steam_friend_code }}"></i>
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div>
                <dl class="grid grid-cols-1 gap-5 sm:grid-cols-4">
                    <div class="bg-white dark:bg-gray-700 overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-200 truncate">
                                Points Total
                            </dt>
                            <dd class="mt-1 text-3xl font-semibold text-gray-900 dark:text-white">
                                {{ $driver->race_results_sum_points }}
                            </dd>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-700 overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-200 truncate">
                                Races Completed
                            </dt>
                            <dd class="mt-1 text-3xl font-semibold text-gray-900 dark:text-white">
                                {{ $driver->race_results_count }}
                            </dd>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-700 overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-200 truncate">
                                Average Finish
                            </dt>
                            <dd class="mt-1 text-3xl font-semibold text-gray-900 dark:text-white">
                                {{ number_format($driver->race_results_avg_position, 1) }}
                            </dd>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-700 overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-200 truncate">
                                Average Penalties
                            </dt>
                            <dd class="mt-1 text-3xl font-semibold text-gray-900 dark:text-white">
                                {{ number_format($driver->race_results_avg_num_penalties, 1) }}
                            </dd>
                        </div>
                    </div>
                </dl>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                <div class="mt-5 bg-white dark:bg-gray-700 overflow-hidden shadow rounded-lg">
                    <h3 class="mt-2 font-medium text-center text-gray-900 dark:text-white">
                        Position Change
                    </h3>
                    <div class="m-4">
                        <canvas id="positionDelta"></canvas>
                    </div>
                </div>

                <div class="mt-5 bg-white dark:bg-gray-700 overflow-hidden shadow rounded-lg">
                    <h3 class="mt-2 font-medium text-center text-gray-900 dark:text-white">
                        % off Best Sectors
                    </h3>
                    <div class="m-4">
                        <canvas id="qualiDeltasChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                    Recent Results
                </h3>

                <div class="mt-5">
                    @include('drivers.partials.results')
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
        <script>
            let clipboard = new ClipboardJS('.friend-code');
            const notyf = new Notyf();
            clipboard.on('success', function(e) {
                notyf.success('Copied to clipboard');
            });

            let isDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (isDarkMode) {
                Chart.defaults.global.defaultFontColor = 'white';
            }

            const positionDeltaChart = document.getElementById('positionDelta')
            const positionChange = @json($positions->map(fn ($p) => $p->grid_position - $p->position));
            let labels = @json($positions->map->country);

            new Chart(positionDeltaChart, {
                type: 'line',
                data: {
                    labels,
                    datasets: [{
                        label: 'Position Change',
                        data: positionChange,
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                },
                plugins: [{
                    beforeRender: function (x, options) {
                        var c = x.chart
                        var dataset = x.data.datasets[0]
                        var yScale = x.scales['y-axis-0']
                        var yPos = yScale.getPixelForValue(0)

                        var gradientFill = c.ctx.createLinearGradient(0, 0, 0, c.height)
                        gradientFill.addColorStop(0, '#34D399')
                        gradientFill.addColorStop(yPos / c.height - 0.01, '#34D399')
                        gradientFill.addColorStop(yPos / c.height + 0.01, '#F87171')
                        gradientFill.addColorStop(1, '#F87171')

                        var model = x.data.datasets[0]._meta[Object.keys(dataset._meta)[0]].dataset._model
                        model.backgroundColor = gradientFill
                    }
                }]
            })



            const qualiDeltasChart = document.getElementById('qualiDeltasChart')
            labels = @json($sectorDeltas->map->country);
            let results = @json($sectorDeltas);

            /**
             * Calculate the rounded % time off of the best sector produced
             *
             * @param time
             * @param delta
             * @returns {number}
             */
            const calcPercentageOffBest = (time, delta) => {

                if (!time || !delta) {
                    return 0;
                }

                const overallBest = time - delta;
                const percentageOff = ((time - overallBest) / overallBest) * 100

                return Number(percentageOff).toFixed(4);
            }

            new Chart(qualiDeltasChart, {
                type: 'line',
                data: {
                    labels,
                    datasets: [{
                        label: '% off Best Sector 1',
                        data: results.map(r => calcPercentageOffBest(r.best_s1_time, r.best_s1_delta)),
                        backgroundColor: '#F59E0B',
                        fill: false
                    },{
                        label: '% off Best Sector 2',
                        data: results.map(r => calcPercentageOffBest(r.best_s2_time, r.best_s2_delta)),
                        backgroundColor: '#10B981',
                        fill: false
                    },{
                        label: '% off Best Sector 3',
                        data: results.map(r => calcPercentageOffBest(r.best_s3_time, r.best_s3_delta)),
                        backgroundColor: '#3B82F6',
                        fill: false
                    },{
                        label: '% off Best Time',
                        data: results.map(r => {
                            const bestLap = r.best_s1_time + r.best_s2_time + r.best_s3_time;
                            return calcPercentageOffBest(bestLap, r.lap_delta)
                        }),
                        backgroundColor: 'red',
                        fill: false
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            })
        </script>
    </x-slot>


</x-app-layout>
