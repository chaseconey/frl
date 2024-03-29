<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-gray-800 dark:text-gray-100 text-xl leading-tight">
            {{ __('Races') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="p-6">

                    <div class="mb-4" x-data="{ filters_open: false }">
                        <form>
                            <div class="w-full mb-4">
                                <label for="search" class="sr-only">Search</label>
                                <input type="text" value="{{ Request::get('search') }}" name="search" id="search" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Search...">
                            </div>
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4" style="display: none;" x-show="filters_open" x-transition>
                                <div>
                                    <label for="division_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Division</label>
                                    <select id="division_id" name="division_id"
                                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                            onchange="this.closest('form').submit()"
                                    >
                                        <option></option>
                                        @foreach($divisions as $division)
                                            <option value="{{ $division->id }}" @if(Request::get('division_id') == $division->id) selected @endif>{{ $division->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>

                        <div class="flex justify-center my-2" @click="filters_open = !filters_open">
                            <a x-text="filters_open ? 'Hide Filters': 'Show Filters'" class="text-gray-600 dark:text-gray-300 text-sm cursor-pointer"></a>
                        </div>

                    </div>

                    @include('races.partials.table', ['races' => $races])

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
