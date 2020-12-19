<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 py-12 max-w-7xl mx-auto ">

        @include('components.races-detail-list', ['races' => $latestRaces, 'title' => 'Latest Races'])

        @if(count($myRaces) > 0)
            @include('components.races-detail-list', ['races' => $myRaces, 'title' => 'My Races'])
        @else
            @include('dashboard.partials.no-races')
        @endif

    </div>
</x-app-layout>
