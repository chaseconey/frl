<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Races') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="mb-4">
                        <p>Filters</p>
                        <form class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                            <div>
                                <label for="division_id" class="block text-sm font-medium text-gray-700">Division</label>
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
                        </form>
                    </div>

                    @include('races.partials.table', ['races' => $races])

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
