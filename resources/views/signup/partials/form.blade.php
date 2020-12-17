
@php
    $selected = $divisions->keyBy('id')[Request::get('division_id')];
    $markdown = new Parsedown();
@endphp

<div>
    <h2 class="my-4 text-lg font-bold">{{ $selected->name }}</h2>

    <article class="prose lg:prose-xl">
        {!! $markdown->text($selected->description) !!}
    </article>

</div>

<form method="POST" action="{{ route('signup.store') }}">
    @csrf
    <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">

        <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">

            <input type="hidden" name="division_id" value="{{ Request::get('division_id') }}">

            <div
                class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                <label for="f1_team_id"
                       class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                    Desired Racing Number
                </label>
                <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <select id="f1_team_id" name="f1_team_id" autocomplete="f1_team_id"
                            class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div
                class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                <label for="f1_number_id"
                       class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                    Desired Racing Number
                </label>
                <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <select id="f1_number_id" name="f1_number_id" autocomplete="f1_number_id"
                            class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        @foreach($numbers as $number)
                            <option value="{{ $number->id }}">{{ $number->racing_number }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>
    </div>

    <div class="pt-5">
        <div class="flex justify-end">
            <button type="submit"
                    class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Submit
            </button>
        </div>
    </div>
</form>
