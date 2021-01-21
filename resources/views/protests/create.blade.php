<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Protests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @php
                        $driver = auth()->user()->driverForDivision(Request::get('division_id'));
                    @endphp

                    @if($driver)
                        @include('protests.partials.form', ['driver_id' => $driver->id])
                    @else
                        <x-alert-warning>
                            <span>You do not have a driver claimed in this division.</span>
                            <p class="text-sm font-medium underline text-yellow-700 hover:text-yellow-600"><a class="underline" href="{{ route('divisions.index') }}">Claim Driver</a></p>
                        </x-alert-warning>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
