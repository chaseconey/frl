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
                        </div>
                        <div class="ml-4 mt-2 flex-shrink-0">
                            <a href="{{ route('divisions.standings.index', $division->id) }}">
                                <button type="button"
                                        class="relative inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Standings
                                </button>
                            </a>
                        </div>
                    </div>

                </div>
                @include('divisions.partials.table', ['drivers' => $division->drivers])
            </div>
        @endforeach

    </div>
</x-app-layout>