<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Divisions') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto">

        @if(count($divisions) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($divisions as $division)
                <div class="bg-white dark:bg-gray-700 shadow sm:rounded-t-md">
                    <div class="px-4 py-5 overflow-hidden sm:px-6">
                        <div class="-ml-4 -mt-2 flex items-center justify-between flex-wrap sm:flex-nowrap">
                            <div class="ml-4 mt-2">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                                    {{ $division->name }}
                                </h3>
                                <div>
                                    @foreach($division->drivers->countBy('type') as $type => $count)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-mediumbg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-100">
                                        {{ \App\Enums\DriverType::fromValue($type)->description }}: {{ $count }}
                                    </span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="ml-4 mt-2 flex-shrink-0">
                                <a href="{{ route('standings.matrix', $division->id) }}">
                                    <button type="button"
                                            class="relative inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white dark:text-gray-900 bg-indigo-600 dark:bg-indigo-400 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Standings
                                    </button>
                                </a>
                            </div>
                        </div>

                    </div>
                    @foreach($division->drivers->groupBy('type')->sortByDesc(fn($drivers) => $drivers->count()) as $type => $drivers)
                    <div class="mt-4">
                        <div class="ml-4">
                            <h4 class="text-md leading-6 font-medium text-gray-900 dark:text-white">
                                {{ \App\Enums\DriverType::fromValue($type)->description }}
                            </h4>
                        </div>
                        @include('divisions.partials.table', ['drivers' => $drivers])
                    </div>
                    @endforeach
                </div>
            @endforeach
        </div>
        @else
            <x-alert-warning>
                No active divisions currently. Stay tuned!
            </x-alert-warning>
        @endif

    </div>
    <x-slot name="scripts">
        <script>
            new ClipboardJS('.friend-code');
            const notyf = new Notyf();
        </script>
    </x-slot>
</x-app-layout>
