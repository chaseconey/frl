<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Standings") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                @foreach($divisions as $division)
                    <a class="flex justify-center bg-white p-4 shadow rounded hover:bg-gray-100"
                       href="{{ route('divisions.standings.index', ['division' => $division]) }}">
                        {{ $division->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

</x-app-layout>
