<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __("Team Standings") }}
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
                        @include('divisions.standings.partials.matrix-table', ['standings' => $standings])
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
