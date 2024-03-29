<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ $division->name }} Standings
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-700 border-b border-gray-200 dark:border-gray-800">

                    <div class="my-4">
                        @include('divisions.standings.partials.tabs', ['division' => $division])
                    </div>

                    <div class="my-4">
                        <canvas id="graph"></canvas>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>
        <script>

            let isDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches
            if (isDarkMode) {
                Chart.defaults.color = 'white'
            }

            let labels = @json($races->map(fn ($r) => $r->track->country));
            let plot = @json($plot)

            const ctx = document.getElementById('graph').getContext('2d');

            const randomColor = () => `#${Math.floor(Math.random() * 16777215).toString(16)}`;
            const teamColors = {
                'Alfa Romeo': '#900000',
                'Alpha Tauri': '#91ABC8',
                'Ferrari': '#DC0000',
                'Haas': '#787878',
                'McLaren': '#FF8700',
                'Mercedes': '#00D2BE',
                'Racing Point': '#F596C8',
                'Red Bull Racing': '#0600EF',
                'Renault': '#FFF500',
                'Williams': '#005AFF',
                'Aston Martin': '#006F62',
                'Alpine': '#0090FF'
            }

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels,
                    datasets: plot.map(d => {
                        return {
                            label: d.driver.name,
                            data: d.results,
                            fill: false,
                            borderColor: teamColors[d.driver.f1_team.name] || randomColor(),
                        }
                    })
                },
                options: {
                    bezierCurve: false,
                    legend: {
                        display: false
                    }
                }
            })
        </script>
    </x-slot>

</x-app-layout>


