@php
    $markdown = new Parsedown();
@endphp

@include('components.form-errors', ['errors' => $errors])

<div>
    <h2 class="my-4 text-lg font-bold dark:text-gray-100">{{ $division->name }}</h2>

    <article class="prose lg:prose-xl dark:text-gray-100">
        {!! $markdown->text($division->description) !!}
    </article>

</div>

<form method="POST" action="{{ route('signup.store') }}">
    @csrf
    <div class="space-y-8 divide-y divide-gray-200 dark:divide-gray-800 sm:space-y-5">

        <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">

            <input type="hidden" name="division_id" value="{{ Request::get('division_id') }}">
            <input type="hidden" name="type" value="{{ Request::has('reserve') ? 'RESERVE' : 'FULL_TIME' }}">

            <div
                class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 dark:border-gray-800 sm:pt-5">
                <label for="type"
                       class="block text-sm font-medium text-gray-700 dark:text-gray-200 sm:mt-px sm:pt-2">
                    Driver Type
                </label>
                <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <a href="{{ route('signup.create', ['reserve' => 1, 'division_id' => Request::get('division_id')]) }}">
                        <button type="button"
                                class="{{ Request::has('reserve') ? 'bg-green-600 hover:bg-green-700' : 'bg-gray-600 hover:bg-gray-700' }} inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Reserve
                        </button>
                    </a>
                    <a href="{{ route('signup.create', ['division_id' => Request::get('division_id')]) }}">
                        <button type="button"
                                class="{{ !Request::has('reserve') ? 'bg-green-600 hover:bg-green-700' : 'bg-gray-600 hover:bg-gray-700' }} ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Full Time
                        </button>
                    </a>
                </div>
            </div>

            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 dark:border-gray-800 sm:pt-5">
                <label for="steam_friend_code" class="block text-sm font-medium text-gray-700 dark:text-gray-200 sm:mt-px sm:pt-2">
                    Steam Friend Code
                    <p class="mt-1 text-gray-500 dark:text-gray-400">Find this in your "Add a Friend" area in Steam.</p>
                </label>
                <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <input type="text" name="steam_friend_code" id="steam_friend_code" class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>

            <div
                class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 dark:border-gray-800 sm:pt-5">
                <label for="f1_team_id"
                       class="block text-sm font-medium text-gray-700 dark:text-gray-200 sm:mt-px sm:pt-2">
                    Desired Team
                    <p class="mt-1 text-gray-500 dark:text-gray-400">Choose a team. For Reserve drivers, in practice, you will be assigned any available team.</p>
                </label>
                <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <select id="f1_team_id" name="f1_team_id" autocomplete="f1_team_id"
                            class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        @foreach($teams as $team)
                            <option
                                value="{{ $team->id }}"
                                @if(!Request::has('reserve') && $team->drivers_count >= 2)disabled="disabled"@endif
                            >
                                {{ $team->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div
                class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 dark:border-gray-800 sm:pt-5">
                <label for="f1_number_id"
                       class="block text-sm font-medium text-gray-700 dark:text-gray-200 sm:mt-px sm:pt-2">
                    Desired Racing Number
                    <p class="mt-1 text-gray-500 dark:text-gray-400">Choose an available in-game number to use for all official league races.</p>
                </label>
                <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <select id="f1_number_id" name="f1_number_id" autocomplete="f1_number_id"
                            class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        @foreach($numbers as $id => $number)
                            <option value="{{ $id }}">{{ $number }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div
                class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 dark:border-gray-800 sm:pt-5">
                <label for="equipment"
                       class="block text-sm font-medium text-gray-700 dark:text-gray-200 sm:mt-px sm:pt-2">
                    Equipment
                </label>
                <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <select id="equipment" name="equipment" autocomplete="equipment"
                            class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        @foreach(\App\Enums\DriverEquipment::asArray() as $name => $id)

                            <option value="{{ $id }}">
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 dark:border-gray-800 sm:pt-5">
                <div></div>
                <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <div>
                        <div class="relative flex items-start">
                            <div class="flex items-center h-5">
                                <input id="accept_rules" name="accept_rules" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 dark:text-indigo-400 border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="accept_rules" class="font-medium text-gray-700 dark:text-gray-200">I have read and accept <a href="{{ config('frl.rules_path') }}" target="_blank" class="underline">all league rules</a>.</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="pt-5">
        <div class="flex justify-end">
            <button type="submit"
                    class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white dark:text-gray-900 bg-indigo-600 dark:bg-indigo-400 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Submit
            </button>
        </div>
    </div>
</form>
