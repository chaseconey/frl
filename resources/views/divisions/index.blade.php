<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Divisions') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 py-12 max-w-7xl mx-auto">

        @foreach($divisions as $division)
            <div class="bg-white shadow sm:rounded-t-md">
                <div class="px-4 py-5 overflow-hidden sm:px-6">
                    <div class="-ml-4 -mt-2 flex items-center justify-between flex-wrap sm:flex-nowrap">
                        <div class="ml-4 mt-2">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                {{ $division->name }}
                            </h3>
                            <div>
                                @foreach($division->drivers->countBy('type') as $type => $count)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    {{ \App\Models\Driver::TYPES[$type] }}: {{ $count }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                        <div class="ml-4 mt-2 flex-shrink-0">
                            <a href="{{ route('standings.matrix', $division->id) }}">
                                <button type="button"
                                        class="relative inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Standings
                                </button>
                            </a>
                        </div>
                    </div>

                </div>
                @foreach($division->drivers->groupBy('type') as $type => $drivers)
                <div class="mt-4">
                    <div class="ml-4">
                        <h4 class="text-md leading-6 font-medium text-gray-900">
                            {{ \App\Models\Driver::TYPES[$type] }}
                        </h4>
                    </div>
                    @include('divisions.partials.table', ['drivers' => $drivers])
                </div>
                @endforeach
            </div>
        @endforeach

    </div>
</x-app-layout>
