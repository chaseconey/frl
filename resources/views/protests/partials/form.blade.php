@include('components.form-errors', ['errors' => $errors])

<div>

    @include('protests.partials.rules')

</div>

<form method="POST" action="{{ route('protests.store') }}">
    @csrf

    <input type="hidden" name="driver_id" value="{{ $driver_id }}">

    <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">

        <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">

            <div
                class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                <label for="protested_driver_id"
                       class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                    Protested Driver
                </label>
                <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <select id="protested_driver_id" name="protested_driver_id" autocomplete="protested_driver_id"
                            class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        @foreach($drivers as $driver)
                            <option
                                @if(old('protested_driver_id') == $driver->id) selected @endif
                                value="{{ $driver->id }}"
                            >
                                {{ $driver->name }} - {{ $driver->f1Team->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div
                class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                <label for="race_id"
                       class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                    Track
                </label>
                <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <select id="race_id" name="race_id" autocomplete="race_id"
                            class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        @foreach($races as $race)
                            <option
                                value="{{ $race->id }}"
                                @if(Request::get('race_id') == $race->id) selected @endif
                            >
                                {{ country_code_to_name($race->track->country) }} - {{ $race->track->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                <label for="video_url" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                    Video URL
                    <p class="mt-1 text-gray-500">If the video is over 5 minutes long, add a timestamp. Protests without
                        a timestamp for videos over 5 minutes will be automatically dismissed.</p>
                </label>
                <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <input type="text" name="video_url" id="video_url"
                           class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md"
                           value="{{ old('video_url') }}"
                    >
                </div>
            </div>

            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                <label for="description" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                    Description of the incident
                </label>
                <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <textarea id="description" name="description" rows="3" class="max-w-lg shadow-sm block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">{{ old('description') }}</textarea>
                </div>
            </div>

            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                <label for="rules_breached" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                    Which rules were breached?
                </label>
                <div class="mt-1 sm:mt-0 sm:col-span-2">
                    <textarea id="rules_breached" name="rules_breached" rows="3" class="max-w-lg shadow-sm block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">{{ old('rules_breached') }}</textarea>
                    <p class="mt-2 text-sm text-gray-500">Please provide the numeric rules (see above) that were broken in this incident.</p>
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
