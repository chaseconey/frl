<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $driver->name }}
            <span class="text-lg text-gray-600">#{{ $driver->f1Number->racing_number }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div>
                <dl class="grid grid-cols-1 gap-5 sm:grid-cols-4">
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Points Total
                            </dt>
                            <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                {{ $driver->race_results_sum_points }}
                            </dd>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Races Completed
                            </dt>
                            <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                {{ $driver->race_results_count }}
                            </dd>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Average Finish
                            </dt>
                            <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                {{ number_format($driver->race_results_avg_position, 1) }}
                            </dd>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Average Penalties
                            </dt>
                            <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                {{ number_format($driver->race_results_avg_num_penalties, 1) }}
                            </dd>
                        </div>
                    </div>
                </dl>
            </div>

            <div class="mt-5">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Recent Results
                </h3>

                <div class="mt-5">
                    @include('drivers.partials.results')
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
