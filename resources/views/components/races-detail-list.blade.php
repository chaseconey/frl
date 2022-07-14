<div class="bg-white dark:bg-gray-700 shadow overflow-hidden sm:rounded-md">
    <div class="bg-white dark:bg-gray-700 px-4 py-5 border-b border-gray-200 dark:border-gray-800 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
            {{ $title ?? 'Races' }}
        </h3>
    </div>
    <ul class="divide-y divide-gray-200 dark:divide-gray-800">
        @foreach($races as $race)
        <li>
            <x-link :href="route('race.results.index', $race->id)">
                <div class="flex items-center px-4 py-4 sm:px-6">
                    <div class="min-w-0 flex-1 flex items-center">
                        <div class="flex-shrink-0">
                            <x-track-avatar :track="$race->track"></x-track-avatar>
                        </div>
                        <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                            <div>
                                <p class="text-sm font-medium text-indigo-600 dark:text-indigo-400 truncate">{{ $race->division->name }} | {{ $race->track->name }}</p>
                                <p class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-200">
                                    <span class="truncate">{{ country_code_to_name($race->track->country) }}</span>
                                </p>
                            </div>
                            <div class="hidden md:block">
                                <div>
                                    <p class="text-sm text-gray-900 dark:text-white">
                                        {{ $race->results_count }} {{ Str::plural('Driver', $race->results_count) }}
                                    </p>
                                    <p class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-200">
                                        <!-- Heroicon name: check-circle -->
                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        Completed {{ $race->race_time->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <!-- Heroicon name: chevron-right -->
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </x-link>
        </li>
        @endforeach
    </ul>
</div>
