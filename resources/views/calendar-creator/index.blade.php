<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            Calendar Creator
        </h2>
    </x-slot>

    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0bg-gray-100 dark:bg-gray-800" x-data>

        @if(session()->has('notice'))
            <x-notice :message="session('notice')" />
        @endif

        @if(!request()->has('num_races'))
            <form action="{{ route('calendar-creator.index') }}">

                <div>
                    <x-label for="division_id" value="Division" />

                    <select id="division_id" name="division_id"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                    >
                        @foreach($divisions as $division)
                            <option value="{{ $division->id }}">{{ $division->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <x-label for="num_races" value="# of Races" />

                    <x-input id="num_races" class="block mt-1 w-full" type="number" name="num_races" :value="old('num_races')" required autofocus />
                </div>

                <div>
                    <x-label for="gap_every" value="Gap Every n Races" />

                    <x-input id="gap_every" class="block mt-1 w-full" type="number" name="gap_every" :value="old('gap_every')" required />
                </div>

                <div>
                    <x-label for="starting_on" value="Starting On" />

                    <x-input id="starting_on" class="block mt-1 w-full" type="datetime-local" name="starting_on" :value="old('starting_on')" required />
                </div>

                <x-button class="ml-3 mt-4">Submit</x-button>
            </form>
        @else
            <x-form-errors />
            <form action="{{ route('calendar-creator.store') }}" method="POST" class="flex flex-col gap-4">
                @csrf

                <input type="hidden" name="division_id" value="{{ request()->get('division_id') }}">

                @for($x = 0; $x < request()->get('num_races'); $x++)

                    @php
                        $startingDate = request()->get('starting_on');
                        $gapEvery = request()->get('gap_every');
                        $gaps = floor($x/$gapEvery);
                        $date = \Carbon\Carbon::make($startingDate)->addWeeks($x + $gaps)->toDateTimeLocalString();
                    @endphp

                    {{-- Show when we have gaps more clearly in the UI --}}
                    @if($x > 0 && $x % $gapEvery === 0)
                        <div class="text-gray-400 italic my-4 text-center">Gap week</div>
                    @endif

                    <div class="flex items-center gap-4 race-item" id="race-{{ $x }}">

                        <div>{{ $x + 1 }}</div>

                        <div>
                            <x-label for="track" value="Track" />

                            <select id="track" name="race[{{ $x }}][track_id]"
                                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                            >
                                <option></option>
                                @foreach($tracks as $track)
                                    <option value="{{ $track->id }}" @if($loop->index === $x) selected @endif>{{ $track->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-label for="race_time" value="Racing On" />

                            <x-input id="race_time" class="block mt-1 w-full" type="datetime-local" name="race[{{ $x }}][race_time]" :value="$date" required />
                        </div>

                        <div class="text-gray-300 cursor-pointer" @click="removeItem">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
                    </div>
                @endfor

                <div class="text-center">
                    <x-button>Submit</x-button>
                    <a href="{{ route('calendar-creator.index') }}">
                        <x-button type="button">Reset</x-button>
                    </a>
                </div>

            </form>
        @endif

    </div>

    <x-slot name="scripts">

        <script>
            function removeItem(e) {
                e.target.closest('.race-item').remove();
            }
        </script>

    </x-slot>

</x-app-layout>
