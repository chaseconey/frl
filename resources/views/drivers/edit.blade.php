<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editing {{ $driver->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @include('components.form-errors', ['errors' => $errors])

                    @if(session()->has('notice'))
                        <x-notice :message="session('notice')" />
                    @endif


                    <form method="POST" action="{{ route('drivers.update', $driver) }}">
                        @csrf

                        @method('PATCH')

                        <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">

                            <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">

                                <div
                                    class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                    <label for="equipment"
                                           class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                        Equipment
                                    </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                        <select id="equipment" name="equipment" autocomplete="equipment"
                                                class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                            @foreach(\App\Enums\DriverEquipment::asArray() as $name => $id)

                                                <option
                                                    value="{{ $id }}"
                                                    @if((string)$driver->equipment === $id)selected="selected"@endif
                                                >
                                                    {{ $name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                    <label for="steam_friend_code" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                        Steam Friend Code
                                        <p class="mt-1 text-gray-500">Find this in your "Add a Friend" area in Steam.</p>
                                    </label>
                                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                                        <input type="text" name="steam_friend_code" value="{{ $driver->steam_friend_code }}" id="steam_friend_code" class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
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

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
