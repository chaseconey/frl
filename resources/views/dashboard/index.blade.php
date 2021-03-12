<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 py-12 max-w-7xl mx-auto">

        @include('components.races-detail-list', ['races' => $latestRaces, 'title' => 'Latest Races'])

        @if(count($myRaces) > 0)
            @include('components.races-detail-list', ['races' => $myRaces, 'title' => 'My Races'])
        @else
            @include('dashboard.partials.no-races')
        @endif

    </div>

    <div class="grid grid-cols-1 py-12 max-w-7xl mx-auto">
        <div class="bg-white shadow overflow-hidden sm:rounded-md p-4">
            <ul class="divide-y divide-gray-200">
                @foreach($feed as $event)
                    <li class="py-4">
                        <div class="flex space-x-3">
                            <x-user-avatar :user="$event->causer" />
                            <div class="flex-1 space-y-1">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-sm font-medium">{{ $event->causer->name }}</h3>
                                    <p class="text-sm text-gray-500">{{ $event->created_at->diffForHumans() }}</p>
                                </div>
                                <p class="text-sm text-gray-500">{{ $event->description }}</p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>
