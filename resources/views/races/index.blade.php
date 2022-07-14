<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-gray-800 dark:text-gray-100 text-xl leading-tight">
            {{ __('Race Calendar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-700 shadow overflow-hidden sm:rounded-md">
                <x-race-calendar />
            </div>
        </div>
    </div>

</x-app-layout>
