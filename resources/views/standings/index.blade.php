<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __("Standings") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                @foreach($divisions as $division)
                    <a class="flex justify-center bg-white dark:bg-gray-700 p-4 shadow rounded hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:bg-gray-800 dark:text-gray-100"
                       href="{{ route('standings.matrix', ['division' => $division]) }}">
                        {{ $division->name }}
                    </a>
                @endforeach
            </div>
            <div class="flex text-center pt-8">
                <a class="text-sm text-gray-600 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-200 w-full"
                   href="{{ route('standings.index', ['show-closed' => 1]) }}">
                    Show Old Divisions
                </a>
            </div>
        </div>
    </div>

</x-app-layout>
