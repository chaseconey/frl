<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 py-12">
            @if($lastRace)
                <x-single-race-detail :race="$lastRace" title="Last Race"/>
            @endif

            @if($nextRace)
                <x-single-race-detail :race="$nextRace" title="Next Race"/>
            @endif

{{--            <div class="justify-end flex gap-4">--}}
{{--                <x-link :href="route('races.list')" :primary="false">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">--}}
{{--                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />--}}
{{--                    </svg>--}}
{{--                </x-link>--}}
{{--                <x-link :href="route('races.index')" :primary="false">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">--}}
{{--                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />--}}
{{--                    </svg>--}}
{{--                </x-link>--}}
{{--            </div>--}}
        </div>

        <div class="w-full pb-12">
            @if(count($results) > 0)
                <h2 class="text-lg leading-6 font-medium text-gray-900 dark:text-white my-2">Recent Results</h2>
                @include('drivers.partials.results', ['results' => $results])
            @else
                <div class="py-4 px-4 sm:px-6 dark:text-gray-100">
                    No recent results
                </div>
            @endif
        </div>


        <div class="grid grid-cols-1 pb-12">
            @include('dashboard.partials.feed', ['feed' => $feed])
        </div>
    </div>
</x-app-layout>
