<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Race Results | {$race->track->name} | {$race->division->name}") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="my-4">
                        @include('race-results.partials.tabs')
                    </div>

                    <div class="my-4">
                        @include('race-results.partials.table', ['race' => $race])
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
