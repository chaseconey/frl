<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Standings") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <h2>Select a Division</h2>

                    <ul>
                        @foreach($divisions as $division)
                        <li><a href="{{ route('divisions.standings.index', ['division' => $division]) }}">{{ $division->name }}</a></li>
                        @endforeach
                    </ul>

                    <div class="my-4">
{{--                        @include('standings.partials.tabs', ['divisions' => $divisions])--}}
                    </div>

                    <div class="my-4">
{{--                        @include('standings.partials.table', ['standings' => $standings])--}}
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
