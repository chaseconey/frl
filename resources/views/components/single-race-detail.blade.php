@props([
    'title',
    'race'
])

<x-section :title="$title">
    <div>
        <x-link :href="route('race.results.index', $race->id)">
            <div class="flex items-center px-4 py-4 sm:px-6">
                <div class="min-w-0 flex-1 flex items-center">
                    <div class="flex-shrink-0">
                        <x-track-avatar :track="$race->track"></x-track-avatar>
                    </div>
                    <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                        <div>
                            <p class="text-sm font-medium text-indigo-600 dark:text-indigo-400 truncate">{{ $race->division->name }}
                                | {{ $race->track->name }}</p>
                            <p class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-200">
                                <span class="truncate">{{ country_code_to_name($race->track->country) }}</span>
                            </p>
                        </div>
                        <div class="hidden md:block">
                            <div>
                                <p class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-200">
                                    @if($race->race_time <= now())
                                        <!-- Heroicon name: check-circle -->
                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-green-400"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                             aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                  d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                        Completed {{ $race->race_time->diffForHumans() }}
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Starts {{ $race->race_time->diffForHumans() }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <!-- Heroicon name: chevron-right -->
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                         fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                              clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </x-link>
    </div>
</x-section>
