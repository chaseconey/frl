<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Sign Up') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-700 border-b border-gray-200 dark:border-gray-800">

                    @php
                        $divDriver = auth()->user()->drivers->where('division_id', $division->id)->first()
                    @endphp

                    @if(!$divDriver)
                        @include('signup.partials.form')
                    @else
                        <x-alert-warning>
                            <span>You already are enrolled in {{ $division->name }} as {{ $divDriver->name }}</span>
                            <p class="text-sm font-medium underline text-yellow-700 hover:text-yellow-600"><a class="underline" href="{{ route('signup.index') }}">Try Another Division</a></p>
                        </x-alert-warning>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
