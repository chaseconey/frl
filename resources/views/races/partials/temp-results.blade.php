
<div>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <form action="{{ route($submitRoute, $race->id) }}" method="POST">
                            @csrf
                            <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-600">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 dark:text-gray-200 sm:pl-6">Position</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-200">Racing #</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-200">In-game Name</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-200">Driver</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-200">Status</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-200"></th>
                                </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-700 divide-y divide-gray-200 dark:divide-gray-800">
                                    @foreach($tempResults as $result)
                                    <tr>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-100 sm:pl-6">{{ $result->position }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-100 sm:pl-6">{{ $result->racing_number }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-100 sm:pl-6">{{ $result->name }}</td>
                                        <td @class([
                                                "whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-100",
                                                "bg-red-400 dark:bg-red-800" => !$result->driver_id
                                            ])
                                        >
                                            <select id="driver_id" name="driver_id[{{ $result->position }}]" class="dark:text-gray-100 dark:bg-gray-700 mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                <option></option>
                                                @foreach($drivers as $driver)
                                                    <option @if($result->driver_id === $driver->id) selected @endif value="{{ $driver->id }}">{{ $driver->name }} (#{{ $driver->f1Number->racing_number }})</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-100">{{ \App\Service\F122\UdpSpec::RACE_RESULT_STATUS[$result->codemasters_result_status] }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-red-400"
                                            x-data="{
                                                async deleteResult(e) {
                                                    let res = await axios.delete('{{ route($deleteRoute, [$race, $result]) }}');

                                                    if (res.status === 204) {
                                                        console.log(e.target.closest('tr').remove());
                                                    }
                                                }
                                            }"
                                        >
                                            <button @click="deleteResult" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>

                            <div class="flex my-6 justify-center">
                                <x-button>Submit</x-button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
